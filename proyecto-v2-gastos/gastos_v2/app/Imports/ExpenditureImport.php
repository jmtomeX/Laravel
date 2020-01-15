<?php

namespace App\Imports;

use App\Expenditure;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

//WithHeadingRow para que recoja la cabecera del excel
class ExpenditureImport implements ToModel, WithValidation
{
    /*
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    use Importable;

    public function model(array $row)
    {
        $date = date('Y-m-d', strtotime($row[0]));
        $exp = new Expenditure([
            'date' => "$date",
            //'date' => '2020-01-15',
            'description' => $row[1],
            'amount' => $row[2],
            //'type' => $row[3],
            'type_id' => 1,
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
