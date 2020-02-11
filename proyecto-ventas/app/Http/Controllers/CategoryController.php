<?php

namespace App\Http\Controllers;

use App\category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //dd('listado de categorias');

        $categorias = Category::all();

        return view('private.categorias')
             ->with('cat', $categorias);
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
        $categoria = new Category();
        $categoria->titulo = $request->titulo;
        $categoria->save();

        return redirect()->route('categorias.index');
    }

    /**
     * Display the specified resource.
     *
     * @param \App\category $category
     *
     * @return \Illuminate\Http\Response
     */
    public function show(category $category)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\category $category
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(category $category)
    {
        dd('OK');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\category            $category
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // no está acabado falta la ruta y la vista
        $cat = Category::find($id);
        $cat->titulo = $request->titulo;
        $cat->update();

        return redirect()->route('categorias.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\category $category
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $categoria = Category::find($id);
        $categoria->delete();

        return redirect()->route('categorias.index');
    }
}
