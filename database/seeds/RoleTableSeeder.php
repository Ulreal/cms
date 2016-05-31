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
            'name' => 'chat',
            'display_name' => 'chat',
            'description' => "Permet d'utiliser le chat",
        ]);

        DB::table('roles')->insert([
            'name' => 'forum',
            'display_name' => 'Forum',
            'description' => "Permet d'utiliser le forum",
        ]);

        DB::table('roles')->insert([
            'name' => 'news',
            'display_name' => 'News',
            'description' => "Permet d'utiliser les news",
        ]);

        /* admin */
        $roleadmin = Role::findOrFail(1);
        $admin = User::where('name', '=', 'admin')->first();
        $admin->attachRole($roleadmin);

        /* user */
        $rolechat = Role::findOrFail(2);
        $roleforum = Role::findOrFail(3);
        $rolenews = Role::findOrFail(4);
        $user = User::where('name', '=', 'user')->first();
        $user->attachRole($rolechat);
        $user->attachRole($roleforum);
        $user->attachRole($rolenews);
    }
}
