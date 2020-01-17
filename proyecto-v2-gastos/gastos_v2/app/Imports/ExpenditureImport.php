<?php

namespace App\Imports;

use App\Expenditure;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use App\Type;
use PhpOffice\PhpSpreadsheet\Shared\Date;

//WithHeadingRow para que recoja la cabecera del excel
class ExpenditureImport implements ToModel, WithValidation
{
    private $arrayTypes = array();
    /*
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    use Importable;

    // recogemos todos los tipos en un diccionario poniendole de clave la descripción con KeyBy y pasandolo a array nuevamente con toArray.
    public function __construct()
    {
        $this->arrayTypes = Type::all()->keyBy('description')->toArray();
        //Pasamos a minúsculas
        $this->arrayTypes = array_change_key_case($this->arrayTypes);
        //dd($this->arrayTypes);
        /* Devuelve -->>
          array:9
            "general" => array:5
                "id" => 1
                "created_at" => "2020-01-16 17:49:14"
                "updated_at" => "2020-01-16 17:49:14"
                "description" => "General"
                "category_id" => 1
            ]
            "luz" => array:5
                "id" => 2
                "created_at" => "2020-01-16 17:49:14"
                "updated_at" => "2020-01-16 17:49:14"
                "description" => "Luz"
                "category_id" => 2
            ].....

         */
    }

    public function model(array $row)
    {
        // pasamos a minusculas la descripción que está en el excel $row[1] y recogemos el id que está $row[1]['id']
        $type_id = $this->arrayTypes[strtolower($row[1])]['id'];
        //dd($type_id);
        $date = Date::excelToDateTimeObject($row[0]);
        $exp = new Expenditure([
            'date' => $date->format('Y-m-d'),
            'description' => $row[1],
            'amount' => $row[2],
            'type_id' => $type_id,
        ]);

        return $exp;
    }

    public function rules(): array
    {
        return [
            //'description' => 'regex:/[A-Z]{3}-[0-9]{3}/',
            //'amount' => 'in:2,4,6',
            'amount' => 'between:1,100000',
        ];
    }
}
