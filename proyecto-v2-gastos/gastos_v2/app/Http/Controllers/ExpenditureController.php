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
use Illuminate\Support\Str;

class ExpenditureController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($res = 0)
    {
        $msg = null;
        if ($res > 0) {
            $msg = 'Archivo subido con exito!';
        } else {
            $msg = 'Archivo no se ha procesado!';
        }
        $user = Auth::user();
        $expenditures = Expenditure::join('types', 'type_id', '=', 'types.id')
        ->join('categories', 'category_id', '=', 'categories.id')
        ->where('categories.user_id', '=', $user->id)
        ->selectRaw('expenditures.id as exp_id, date, description, amount,type_id, file, type, category_id, category')
        ->get();
        //$expenditure = Expenditure::orderBy('date', 'DESC')->get();
        $categories = Category::where('categories.user_id', '=', $user->id)->get();

        return view('private.expenditures')
            ->with('categories', $categories)
            ->with('res', $res)
            ->with('gastos', $expenditures);
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
        if ($request->hasFile('your_file')) {
            /*
            $request->validate([
                'your_file' => 'required|image|mimes:jpeg,png,jpg,gif,pdf,xlsx,xls|max:2048',
            ]);
            */
            $imageName = time().'_'.Str::random(10).'.'.$request->your_file->getClientOriginalExtension();

            $request->your_file->move(public_path('img_uploads'), $imageName);
            $expenditure->file = $imageName;
        }

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
        //Comprobamos si tiene asociado un archivo par aeliminarlo:
        if ($expenditure->file != null) {
            $exp_file = public_path().'/img_uploads/'.$expenditure->file;
            if (file_exists($exp_file)) {
                unlink($exp_file);
            }
        }
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
            dd($e);
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
