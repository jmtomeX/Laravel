<?php

namespace App\Http\Controllers;

use App\Type;
use App\Category;
use Illuminate\Http\Request;

class TypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $types = Type::all();
        $categories = Category::orderBy('description', 'Asc')->get();

        return view('private.types')
             ->with('categories', $categories)
             ->with('types', $types);
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
    // insertar un nuevo objeto
    public function store(Request $request)
    {
        $type = new Type();
        $type->category_id = $request->categoria_id;
        $type->description = $request->descripcion;
        $type->save();

        return redirect()->route('types.index');
    }

    /**
     * Display the specified resource.
     *
     * @param \App\type $type
     *
     * @return \Illuminate\Http\Response
     */
    public function show(type $type)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\type $type
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(type $type)
    {
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\type                $type
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, type $type)
    {
        $type = Types::find($id);
        $type->delete();

        return redirect()->route('types.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\type $type
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(type $type)
    {
        $type->delete();

        return redirect()->route('types.index');
    }
}
