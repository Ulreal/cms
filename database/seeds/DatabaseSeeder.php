<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        $this->call(UsersTableSeeder::class);

        // https://github.com/micheleangioni/entrust
        $this->call(RoleTableSeeder::class);

        // seed des configuration
        $this->call(ConfigTableSeeder::class);
    }
}
