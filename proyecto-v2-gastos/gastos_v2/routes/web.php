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
});
Route::get('/import_excel', function () {

    $categories = Category::all();
    //dd($categories);
    return view('private.import_excel')
        ->with('cat', $categories);
})->name('import.excel');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::resource('categories', 'CategoryController');
Route::resource('types', 'TypeController');

// Manipulación archivos
//Route::post('import_excel', 'import-excelController@importExcel')->name('');

//Route::get('import_excel/categories', 'import-excelController@getCategories')->name('getCategories');

//Ruta para cargar con ajax en expenditures.blade, la lista de types partiendo de una categoria:
Route::get('expenditures/types/{cat_id}', 'ExpenditureController@setCategoryId')->name('expenditures.types.categories');
Route::resource('expenditures', 'ExpenditureController');
