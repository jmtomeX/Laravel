<?php

namespace App\Http\Controllers;

use App\Type;
use Auth;
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
        $user = Auth::user();
        $categories = $user->categories()->get();

        //Categorias del usuario:
        $types = Type::join('categories', 'category_id', '=', 'categories.id')
        ->where('categories.user_id', '=', $user->id)
        ->selectRaw('types.id as ID, types.type as DESCRIPTION, category_id')
        ->get();

        //dd($types);

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
        $type->type = $request->type;
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
