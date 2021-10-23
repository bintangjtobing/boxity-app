<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProvincesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('id_provinces')->insert(['id' => 11, 'province_name' => 'ACEH']);
        DB::table('id_provinces')->insert(['id' => 12, 'province_name' => 'SUMATERA UTARA']);
        DB::table('id_provinces')->insert(['id' => 13, 'province_name' => 'SUMATERA BARAT']);
        DB::table('id_provinces')->insert(['id' => 14, 'province_name' => 'RIAU']);
        DB::table('id_provinces')->insert(['id' => 15, 'province_name' => 'JAMBI']);
        DB::table('id_provinces')->insert(['id' => 16, 'province_name' => 'SUMATERA SELATAN']);
        DB::table('id_provinces')->insert(['id' => 17, 'province_name' => 'BENGKULU']);
        DB::table('id_provinces')->insert(['id' => 18, 'province_name' => 'LAMPUNG']);
        DB::table('id_provinces')->insert(['id' => 19, 'province_name' => 'KEPULAUAN BANGKA BELITUNG']);
        DB::table('id_provinces')->insert(['id' => 21, 'province_name' => 'KEPULAUAN RIAU']);
        DB::table('id_provinces')->insert(['id' => 31, 'province_name' => 'DKI JAKARTA']);
        DB::table('id_provinces')->insert(['id' => 32, 'province_name' => 'JAWA BARAT']);
        DB::table('id_provinces')->insert(['id' => 33, 'province_name' => 'JAWA TENGAH']);
        DB::table('id_provinces')->insert(['id' => 34, 'province_name' => 'DI YOGYAKARTA']);
        DB::table('id_provinces')->insert(['id' => 35, 'province_name' => 'JAWA TIMUR']);
        DB::table('id_provinces')->insert(['id' => 36, 'province_name' => 'BANTEN']);
        DB::table('id_provinces')->insert(['id' => 51, 'province_name' => 'BALI']);
        DB::table('id_provinces')->insert(['id' => 52, 'province_name' => 'NUSA TENGGARA BARAT']);
        DB::table('id_provinces')->insert(['id' => 53, 'province_name' => 'NUSA TENGGARA TIMUR']);
        DB::table('id_provinces')->insert(['id' => 61, 'province_name' => 'KALIMANTAN BARAT']);
        DB::table('id_provinces')->insert(['id' => 62, 'province_name' => 'KALIMANTAN TENGAH']);
        DB::table('id_provinces')->insert(['id' => 63, 'province_name' => 'KALIMANTAN SELATAN']);
        DB::table('id_provinces')->insert(['id' => 64, 'province_name' => 'KALIMANTAN TIMUR']);
        DB::table('id_provinces')->insert(['id' => 65, 'province_name' => 'KALIMANTAN UTARA']);
        DB::table('id_provinces')->insert(['id' => 71, 'province_name' => 'SULAWESI UTARA']);
        DB::table('id_provinces')->insert(['id' => 72, 'province_name' => 'SULAWESI TENGAH']);
        DB::table('id_provinces')->insert(['id' => 73, 'province_name' => 'SULAWESI SELATAN']);
        DB::table('id_provinces')->insert(['id' => 74, 'province_name' => 'SULAWESI TENGGARA']);
        DB::table('id_provinces')->insert(['id' => 75, 'province_name' => 'GORONTALO']);
        DB::table('id_provinces')->insert(['id' => 76, 'province_name' => 'SULAWESI BARAT']);
        DB::table('id_provinces')->insert(['id' => 81, 'province_name' => 'MALUKU']);
        DB::table('id_provinces')->insert(['id' => 82, 'province_name' => 'MALUKU UTARA']);
        DB::table('id_provinces')->insert(['id' => 91, 'province_name' => 'PAPUA BARAT']);
        DB::table('id_provinces')->insert(['id' => 94, 'province_name' => 'PAPUA']);
    }
}
