<?php

namespace App\Http\Controllers;

use App\Expenditure;
use App\Category;
use App\Type;
use Auth;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Excel;
use App\Imports\ExpenditureImport;
use Carbon\Carbon;

class ExpenditureController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($res = 0)
    {
        $user = Auth::user();
        $expenditure = Expenditure::join('types', 'type_id', '=', 'types.id')
        ->join('categories', 'category_id', '=', 'categories.id')
        ->where('categories.user_id', '=', $user->id)
        ->get();
        //$expenditure = Expenditure::orderBy('date', 'DESC')->get();
        $categories = Category::where('categories.user_id', '=', $user->id)->get();

        $msg = null;
        if ($res > 0) {
            $msg = 'Archivo subido con exito!';
        }
        if ($res < 0) {
            $msg = 'Archivo no se ha procesado!';
        }

        return view('private.expenditures')
        ->with('categories', $categories)
        ->with('res', $res)
        ->with('gastos', $expenditure);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $expenditure = new Expenditure();
        $expenditure->date = $request->date;
        $expenditure->description = $request->descripcion;
        $expenditure->amount = $request->amount;
        $expenditure->date = $request->fecha;
        $expenditure->type_id = $request->tipo_id;

        $expenditure->save();

        return redirect()->route('expenditures.index');
    }

    /**
     * Display the specified resource.
     *
     * @param \App\expenditure $expenditure
     *
     * @return \Illuminate\Http\Response
     */
    public function show(expenditure $expenditure)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\expenditure $expenditure
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(expenditure $expenditure)
    {
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\expenditure         $expenditure
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, expenditure $expenditure)
    {
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\expenditure $expenditure
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(expenditure $expenditure)
    {
        $expenditure->delete();

        return redirect()->route('expenditures.index');
    }

    public function setCategoryId($cat_id)
    {
        $data = array();
        $res = 0;
        $types = null;
        try {
            $types = Type::where('category_id', '=', $cat_id)->get();
            //} catch (QueryException $ex) {
        } catch (\Throwable $e) { // cualquier excepción
            $res = -1;
        }
        $data['res'] = $res;

        if ($res >= 0) {
            $data['datos'] = $types;
        }

        return response()->json($data);
    }

    private $excel;

    public function __construct(Excel $excel)
    {
        $this->excel = $excel;
    }

    public function import()
    {
        $res = 1;
        try {
            (new ExpenditureImport())->import(request()->file('your_file'), null, \Maatwebsite\Excel\Excel::XLSX);
            //} catch (\Maatwebsite\Excel\Validators\ValidationException $e) {
        } catch (\Exception $e) {
            $res = -1;
        }

        return redirect()->route('expenditures.index', ['res' => $res]);
    }

    // Sin formulario
    // public function import()
    // {
    //     (new ExpenditureImport())->import('gastos.xlsx', null, \Maatwebsite\Excel\Excel::XLSX);

    //     return redirect()->route('expenditures.index', ['msg' => 'Archivo subido con exito!']);
    // }

    // Generar consulta entre 2 fechas y un tipo de gasto
    public function ExpenditureGraphic()
    {
        $expenditure = Expenditure::all();
        //creams 2 objetos tipo carbon con las fechas
        $date1 = new Carbon('date_start');
        $date2 = new Carbon('date_end');

        //aplicamos Eloquent
        $lst = Expenditure::where('date', '>=', $date1)
                ->where('date', '<=', $date2)
                ->where('type_id', '=', type_id)
                ->get();

        return view('private.home')
                ->with('lstExpendToDate', $lst);
    }
}
