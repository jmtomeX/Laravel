<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;

class import-excelController extends Controller
{
        // dar categorías en el import-excel
        public function getCategories()
        {
            $categories = Category::all();
            //dd($categories);
    
            return view('private.import-excel')
            ->with('cat', $categories);
         
        }
    
        public function importExcel( Request $request) {
            $file = $request->file('file');
        }//https://www.youtube.com/watch?v=h0H4Y0U2DGk 
        //4.25 minuto
}
