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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::resource('categories', 'CategoryController');
Route::resource('types', 'TypeController');

//Ruta para cargar con ajax en expenditures.blade, la lista de types partiendo de una categoria:
Route::get('expenditures/types/{cat_id}', 'ExpenditureController@setCategoryId')->name('expenditures.types.categories');
Route::resource('expenditures', 'ExpenditureController');

