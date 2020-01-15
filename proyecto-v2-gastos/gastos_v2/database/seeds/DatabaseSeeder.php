<?php

use Illuminate\Database\Seeder;
use App\Expenditure;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run()
    {
        $this->call(RoleTableSeeder::class);
        $this->call(CategorySeeder::class);
        //$this->call(ExpendituresFactory::class);
        factory(Expenditure::class, 20)->create();
    }
}
