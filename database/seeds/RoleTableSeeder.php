<?php

use App\Role;
use App\User;
use Illuminate\Database\Seeder;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->insert([
            'name' => 'admin',
            'display_name' => 'Administrateur',
            'description' => 'Description du rôle admin',
        ]);

        DB::table('roles')->insert([
            'name' => 'User',
            'display_name' => 'User',
            'description' => "Description du rôle user",
        ]);

        /* admin */
        $roleadmin = Role::findOrFail(1);
        $roleadmin->attachPermission(1);
        $roleadmin->attachPermission(2);
        $roleadmin->attachPermission(3);
        $roleadmin->attachPermission(4);

        $admin = User::where('name', '=', 'admin')->first();
        $admin->attachRole($roleadmin);

        /* user */
        $roleuser = Role::findOrFail(2);
        $roleuser->attachPermission(2);
        $roleuser->attachPermission(3);
        $roleuser->attachPermission(4);

        $user = User::where('name', '=', 'user')->first();
        $user->attachRole($roleuser);
    }
}
