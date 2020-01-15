<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', 'HomeController@listarProductosPublic')->name('public.index');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('productos/listar', 'HomeController@listarProductos')->name('productos.listar');
Route::post('productos/insertar', 'HomeController@addProduct')->name('productos.insertar');
Route::get('productos/eliminar/{id}', 'HomeController@delProduct')->name('productos.eliminar');
Route::get('productos/get/{id}', 'HomeController@getProduct')->name('productos.get');
Route::post('productos/update/{id}', 'HomeController@updateProduct')->name('productos.update');
//Route::get('productos/opiniones/{id}', 'HomeController@getOpinions')->name('productos.opinions');
Route::get('productos/opiniones/{id}', 'HomeController@getOpinions_v2')->name('productos.opinions');
Route::post('productos/public/setOpinion', 'HomeController@setOpinion_public')->name('productos.public.opinion');



Route::get('/about', function () {
    return view('public.about');
})->name('public.about');

//Creamos una ruta de tipo resource para la gestion de las opiniones
Route::resource('opiniones', 'OpinionController');
Route::resource('categorias', 'CategoryController');
