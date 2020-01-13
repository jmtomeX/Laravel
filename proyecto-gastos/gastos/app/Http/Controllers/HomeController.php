<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Expenditure;
use DB;

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
        SELECT categories.description, sum(amount) as TOTAL from Expenditures
            INNER JOIN types ON expenditures.type_id=Types.id
            INNER JOIN categories ON types.category_id=categories.id
            where categories.user_id = 1
            GROUP BY categories.description
        */

        // Con eloquent
        /*
        $totalCats = Expenditure::join('types', 'type_id', '=', 'types.id')
                ->join('categories', 'category_id', '=', 'categories.id')
                ->where('categories.user_id', '=', $user_id)
                ->groupBy('categories.description')
                ->get();
                */
        //->sum('amount');
        $totalCats = Expenditure::select('categories.description', DB::raw('SUM(expenditures.amount) As total'))
            ->join('types', 'type_id', '=', 'types.id')
            ->join('categories', 'category_id', '=', 'categories.id')
            ->where('categories.user_id', '=', $user_id)
            ->groupBy('categories.description')
            ->get();

        //dd($totalCats);
        //dd($totalCats[0]->total);

        return view('private.home')
                ->with('total', $total)
                ->with('totalCats', $totalCats);
    }
}
