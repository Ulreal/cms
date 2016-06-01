<?php

use Illuminate\Database\Seeder;

class ConfigTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $default_settings = [
            ['key' => 'menu_header', 'value' => 'true'],
            ['key' => 'menu_gauche', 'value' => 'true'],
            ['key' => 'menu_droite', 'value' => 'true'],
            ['key' => 'menu_footer', 'value' => 'true'],
            ['key' => 'text_footer', 'value' => 'Réalisé par JB Hénard, Quentin Bettoum et Villers Mickaël'],
            ['key' => 'theme', 'value' => 'theme0'],
        ];

        foreach ($default_settings as $setting) {
            DB::table('config')->insert($setting);
        }
    }
}
