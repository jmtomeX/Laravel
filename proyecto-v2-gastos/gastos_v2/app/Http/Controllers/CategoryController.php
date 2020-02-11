<?php

namespace App\Http\Controllers;

use App\Category;
use Auth;
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
        $user = Auth::user();
        $categorias = Category::where('categories.user_id', '=', $user->id)->get();
        //dd($categorias);

        return view('private.categories')
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
        $categoria->category = $request->category;
        $categoria->user_id = $request->user_id;
        //dd($categoria);
        $categoria->save();

        return redirect()->route('categories.index');
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
        $user = Auth::user();
        $categorias = Category::where('categories.user_id', '=', $user->id)->get();
        //Comprobar que la category es del usuario actual:
        if ($category->user_id != $user->id) {
            $category = null;
        }

        return view('private.categories')
            ->with('cat', $categorias)
            ->with('cat_edit', $category);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\category            $category
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, category $category)
    {
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\category $category
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(category $category)
    {
        $category->delete();

        return redirect()->route('categories.index');
    }
}
