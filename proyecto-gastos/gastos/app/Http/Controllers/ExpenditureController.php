<?php

namespace App\Http\Controllers;

use App\Expenditure;
use App\Category;
use App\Type;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

class ExpenditureController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $expenditure = Expenditure::all();
        //$expenditure = $this->expenditure->orderBy('date', 'DESC')->get(); 
        $categories = Category::all();

        return view('private.expenditures')
            ->with('categories', $categories)
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
}
