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
        $category->category = 'General';
        $category->user_id = $user->id;
        $category->save();

        $type = new Type();
        $type->type = 'General';
        $type->category_id = $category->id;
        $type->save();

        $category = new Category();
        $category->category = 'Hogar';
        $category->user_id = $user->id;
        $category->save();

        $type = new Type();
        $type->type = 'Luz';
        $type->category_id = $category->id;
        $type->save();

        $type = new Type();
        $type->type = 'Gas';
        $type->category_id = $category->id;
        $type->save();

        //********************* */

        $category = new Category();
        $category->category = 'Seguros';
        $category->user_id = $user->id;
        $category->save();

        $type = new Type();
        $type->type = 'Casa';
        $type->category_id = $category->id;
        $type->save();

        $type = new Type();
        $type->type = 'Coche';
        $type->category_id = $category->id;
        $type->save();

        $type = new Type();
        $type->type = 'Moto';
        $type->category_id = $category->id;
        $type->save();

        /* User 2 **** */

        $user = User::find(2);

        $category = new Category();
        $category->category = 'PeterGeneral';
        $category->user_id = $user->id;
        $category->save();

        $type = new Type();
        $type->type = 'PeterGeneral';
        $type->category_id = $category->id;
        $type->save();

        $category = new Category();
        $category->category = 'PeterHogar';
        $category->user_id = $user->id;
        $category->save();

        $type = new Type();
        $type->type = 'PeterLuz';
        $type->category_id = $category->id;
        $type->save();

        $type = new Type();
        $type->type = 'PeterGas';
        $type->category_id = $category->id;
        $type->save();

        //********************* */

        $category = new Category();
        $category->category = 'PeterSeguros';
        $category->user_id = $user->id;
        $category->save();

        $type = new Type();
        $type->type = 'PeterCasa';
        $type->category_id = $category->id;
        $type->save();

        $type = new Type();
        $type->type = 'PeterCoche';
        $type->category_id = $category->id;
        $type->save();

        $type = new Type();
        $type->type = 'PeterMoto';
        $type->category_id = $category->id;
        $type->save();
    }
}
