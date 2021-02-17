<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AgamaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('id_agamas')->insert(['id' => 1, 'agama_name' => 'Kristen Protestan']);
        DB::table('id_agamas')->insert(['id' => 2, 'agama_name' => 'Kristen Katolik']);
        DB::table('id_agamas')->insert(['id' => 3, 'agama_name' => 'Islam']);
        DB::table('id_agamas')->insert(['id' => 4, 'agama_name' => 'Buddha']);
        DB::table('id_agamas')->insert(['id' => 5, 'agama_name' => 'Hindu']);
        DB::table('id_agamas')->insert(['id' => 6, 'agama_name' => 'Kong Hu Cu']);
    }
}
