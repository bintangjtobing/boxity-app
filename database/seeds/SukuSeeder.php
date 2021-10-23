<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SukuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('id_sukus')->insert(['id' => 1, 'suku_name' => 'Sunda']);
        DB::table('id_sukus')->insert(['id' => 2, 'suku_name' => 'Jawa']);
        DB::table('id_sukus')->insert(['id' => 3, 'suku_name' => 'Batak']);
        DB::table('id_sukus')->insert(['id' => 4, 'suku_name' => 'Madura']);
        DB::table('id_sukus')->insert(['id' => 5, 'suku_name' => 'Betawi']);
        DB::table('id_sukus')->insert(['id' => 6, 'suku_name' => 'Minangkabau']);
        DB::table('id_sukus')->insert(['id' => 7, 'suku_name' => 'Tionghoa']);
        DB::table('id_sukus')->insert(['id' => 8, 'suku_name' => 'Bugis']);
        DB::table('id_sukus')->insert(['id' => 9, 'suku_name' => 'Melayu']);
        DB::table('id_sukus')->insert(['id' => 10, 'suku_name' => 'Arab']);
        DB::table('id_sukus')->insert(['id' => 11, 'suku_name' => 'Banten']);
        DB::table('id_sukus')->insert(['id' => 12, 'suku_name' => 'Banjar']);
        DB::table('id_sukus')->insert(['id' => 13, 'suku_name' => 'Bali']);
        DB::table('id_sukus')->insert(['id' => 14, 'suku_name' => 'Sasak']);
        DB::table('id_sukus')->insert(['id' => 15, 'suku_name' => 'Dayak']);
        DB::table('id_sukus')->insert(['id' => 16, 'suku_name' => 'Makassar']);
        DB::table('id_sukus')->insert(['id' => 17, 'suku_name' => 'Cirebon']);
    }
}
