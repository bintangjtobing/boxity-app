<?php

use Illuminate\Database\Seeder;
use Database\Seeders\UserSeeder;
use Database\Seeders\DomisilisSeeder;
use Database\Seeders\KelurahansSeeder;
use Database\Seeders\ProvincesSeeder;
use Database\Seeders\KecamatansSeeder;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UserSeeder::class);
        $this->call(DomisilisSeeder::class);
        $this->call(KelurahansSeeder::class);
        $this->call(ProvincesSeeder::class);
        $this->call(KecamatansSeeder::class);
    }
}
