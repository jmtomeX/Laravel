<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Expenditure;
use DB;
use Khill\Lavacharts\Lavacharts;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        $request->user()->authorizeRoles(['user', 'admin']);
        //Queremos ver total de gastos:
        $user_id = Auth::user()->id;
        //Sin eloquent sql:
        /*
        SELECT sum(amount) as TOTAL from Expenditures
            INNER JOIN types ON expenditures.type_id=Types.id
            INNER JOIN categories ON types.category_id=categories.id
            where categories.user_id = 1
        */

        //Con eloquent:
        $total = Expenditure::join('types', 'type_id', '=', 'types.id')
            ->join('categories', 'category_id', '=', 'categories.id')
            ->where('categories.user_id', '=', $user_id)
            ->sum('amount');

        // Sin eloquent
        /*
        SELECT categories.category, sum(amount) as TOTAL from Expenditures
            INNER JOIN types ON expenditures.type_id=Types.id
            INNER JOIN categories ON types.category_id=categories.id
            where categories.user_id = 1
            GROUP BY categories.category
        */

        // Con eloquent
        /*
        $totalCats = Expenditure::join('types', 'type_id', '=', 'types.id')
                ->join('categories', 'category_id', '=', 'categories.id')
                ->where('categories.user_id', '=', $user_id)
                ->groupBy('categories.category')
                ->get();
                */
        //->sum('amount');
        $totalCats = Expenditure::select('categories.category', DB::raw('SUM(expenditures.amount) As total'))
            ->join('types', 'type_id', '=', 'types.id')
            ->join('categories', 'category_id', '=', 'categories.id')
            ->where('categories.user_id', '=', $user_id)
            ->groupBy('categories.category')
            ->get();

        //dd($totalCats);
        //dd($totalCats[0]->total);

        $lava = new Lavacharts(); // See note below for Laravel

        $population = $lava->DataTable();

        $population->addDateColumn('Fecha')
            ->addNumberColumn('Cantidad €');
        //Obtenemos los gastos agrupados por fecha:
        //SQL pura y dura: SELECT date, sum(amount) as total from expenditures group by date order by date
        $expenditures = Expenditure::join('types', 'type_id', '=', 'types.id')
        ->join('categories', 'category_id', '=', 'categories.id')
        ->where('categories.user_id', '=', $user_id)
        ->orderBy('date', 'desc')
        ->selectRaw('date, sum(amount) as sum')
        ->groupBy('date')
        ->get();
        foreach ($expenditures as $exp) {
            $population->addRow(["$exp->date", $exp->sum]);
        }

        $lava->AreaChart('Population', $population, [
        'title' => 'Gastos anuales',
        'legend' => [
            'position' => 'in',
            ],
            ]);

        // gráfica de queso
        $donut = new Lavacharts();

        $reasons = $donut->DataTable();

        $reasons->addStringColumn('Reasons')
                ->addNumberColumn('Percent');
        foreach ($expenditures as $exp) {
            $reasons->addRow(["$exp->date", $exp->sum]);
        }

        $donut->DonutChart('IMDB', $reasons, [
            'title' => 'Reasons I visit IMDB',
        ]);

        return view('private.home')
                ->with('lava', $lava)
                ->with('donut', $donut)
                ->with('total', $total)
                ->with('totalCats', $totalCats);
    }
}
