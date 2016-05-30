<?php

use App\Permission;
use App\User;
use Illuminate\Database\Seeder;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        /* administrateur */
        DB::table('permissions')->insert([
            'name' => 'global',
            'display_name' => 'Global',
            'description' => "Permet de tout gérer",
        ]);

        /* utilisateur */
        DB::table('permissions')->insert([
            'name' => 'forum',
            'display_name' => 'Forum',
            'description' => "Permet d'utiliser le forum",
        ]);

        DB::table('permissions')->insert([
            'name' => 'news',
            'display_name' => 'News',
            'description' => "Permet de lire les news",
        ]);

        DB::table('permissions')->insert([
            'name' => 'chat',
            'display_name' => 'Chat',
            'description' => "Permet d'utiliser le chat",
        ]);

    }
}
