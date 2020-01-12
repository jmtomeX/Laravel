<?php

use Illuminate\Database\Seeder;
use App\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        DB::table('users')->insert([
            [
            'name' => 'Jose Mari',
            'email' => 'iremti2@gmail.com',
            'password' => bcrypt('11111111'),
            ],
            [
            'name' => 'Mikel',
            'email' => 'mikel@mikel.es',
            'password' => bcrypt('11111111'),
            ],
        ]);
        //Pedimos usuarios aleatorios  usuario:
        factory(User::class, 20)->create();
    }
}
