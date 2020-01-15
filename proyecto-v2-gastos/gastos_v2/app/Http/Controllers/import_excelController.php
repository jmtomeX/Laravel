<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


class import_excelController extends Controller
{
    
        public function importExcel( Request $request) {
            $file = $request->file('file');
        }//https://www.youtube.com/watch?v=h0H4Y0U2DGk 
        //4.25 minuto
}
