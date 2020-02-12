<?php

use App\Category;

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
})->name('index');

Route::get('/import', function () {
    $categories = Category::all();
    //dd($categories);
    return view('private.import_excel')
        ->with('categories', $categories);
})->name('import.excel');

Route::post('/import', 'ExpenditureController@import')->name('import.excel');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::resource('categories', 'CategoryController');
Route::resource('types', 'TypeController');

//Ruta para cargar con ajax en expenditures.blade, la lista de types partiendo de una categoria:
Route::get('expenditures/types/{cat_id}', 'ExpenditureController@setCategoryId')->name('expenditures.types.categories');

Route::get('expenditures/{res?}', 'ExpenditureController@index')->name('expenditures.index');
Route::post('expenditures/graphic', 'ExpenditureController@ExpenditureGraphic')->name('expenditures.graphic');
Route::get('expenditures/graphic', 'ExpenditureController@graphic')->name('expenditures.graphic');
Route::resource('expenditures', 'ExpenditureController', ['except' => ['index']]);
