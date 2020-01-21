<?php

use App\Category;
use App\Type;
use App\User;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $user = User::find(1);

        $category = new Category();
        $category->description = 'General';
        $category->user_id = $user->id;
        $category->save();

        $type = new Type();
        $type->description = 'General';
        $type->category_id = $category->id;
        $type->save();

        $category = new Category();
        $category->description = 'Hogar';
        $category->user_id = $user->id;
        $category->save();

        $type = new Type();
        $type->description = 'Luz';
        $type->category_id = $category->id;
        $type->save();

        $type = new Type();
        $type->description = 'Gas';
        $type->category_id = $category->id;
        $type->save();

        //********************* */

        $category = new Category();
        $category->description = 'Seguros';
        $category->user_id = $user->id;
        $category->save();

        $type = new Type();
        $type->description = 'Casa';
        $type->category_id = $category->id;
        $type->save();

        $type = new Type();
        $type->description = 'Coche';
        $type->category_id = $category->id;
        $type->save();

        $type = new Type();
        $type->description = 'Moto';
        $type->category_id = $category->id;
        $type->save();

        /* User 2 **** */

        $user = User::find(2);

        $category = new Category();
        $category->description = 'PeterGeneral';
        $category->user_id = $user->id;
        $category->save();

        $type = new Type();
        $type->description = 'PeterGeneral';
        $type->category_id = $category->id;
        $type->save();

        $category = new Category();
        $category->description = 'PeterHogar';
        $category->user_id = $user->id;
        $category->save();

        $type = new Type();
        $type->description = 'PeterLuz';
        $type->category_id = $category->id;
        $type->save();

        $type = new Type();
        $type->description = 'PeterGas';
        $type->category_id = $category->id;
        $type->save();

        //********************* */

        $category = new Category();
        $category->description = 'PeterSeguros';
        $category->user_id = $user->id;
        $category->save();

        $type = new Type();
        $type->description = 'PeterCasa';
        $type->category_id = $category->id;
        $type->save();

        $type = new Type();
        $type->description = 'PeterCoche';
        $type->category_id = $category->id;
        $type->save();

        $type = new Type();
        $type->description = 'PeterMoto';
        $type->category_id = $category->id;
        $type->save();
    }
}
