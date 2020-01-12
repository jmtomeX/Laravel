<?php

use App\Role;
use App\User;
use Illuminate\Database\Seeder;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $role = new Role();
        $role->name = 'admin';
        $role->description = 'Administrator';
        $role->save();
        //Crear un usuario administrador y le asociamos el role creado:
        $user = new User();
        $user->name = 'jose mari';
        $user->email = 'iremti2@gmail.com';
        $user->password = bcrypt('11111111');
        $user->save();
        //Creamos en la tabla intermedia la asociacion User/Role
        $user->roles()->attach($role);
        //Otra forma sería: $role->users()->attach($user);

        $role = new Role();
        $role->name = 'user';
        $role->description = 'User';
        $role->save();

        $user = new User();
        $user->name = 'peter';
        $user->email = 'peter@gmail.com';
        $user->password = bcrypt('11111111');
        $user->save();
        //Creamos en la tabla intermedia la asociacion User/Role
        $role->users()->attach($user);
    }
}
