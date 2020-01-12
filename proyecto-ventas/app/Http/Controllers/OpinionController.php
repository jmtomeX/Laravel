<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Opinion;
use App\Product;

class OpinionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //dd('listado de opiniones');
        $opiniones = Opinion::paginate(5);
        //$opiniones = Opinion::all();
        //Obtenemos el listado de productos:
        $productos = Product::all();

        return view('private.opiniones')
            ->with('prs', $productos)
            ->with('opn', $opiniones);
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
        //$product_id = $request->id_prod;
        //dd($request);
        $opinion = new Opinion();
        $opinion->titulo = $request->titulo;
        $opinion->comentario = $request->messagetext;
        $opinion->valor = $request->valor;
        $opinion->product_id = $request->producto_id;
        $opinion->save();

        return redirect()->route('opiniones.index');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int                      $id
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $opinion = Opinion::find($id);
        $opinion->delete();

        return redirect()->route('opiniones.index');
    }
}
