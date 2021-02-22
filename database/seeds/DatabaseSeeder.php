<?php

use Illuminate\Database\Seeder;
use Database\Seeders\UserSeeder;
use Database\Seeders\DomisilisSeeder;
use Database\Seeders\KelurahansSeeder;
use Database\Seeders\ProvincesSeeder;
use Database\Seeders\KecamatansSeeder;
use Database\Seeders\AgamaSeeder;
use Database\Seeders\SukuSeeder;
use Database\Seeders\testingIssue;


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
        $this->call(SukuSeeder::class);
        $this->call(AgamaSeeder::class);
        $this->call(testingIssue::class);
    }
}
