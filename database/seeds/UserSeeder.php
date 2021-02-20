<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'id' => 1,
            'role' => User::ROLES['ADMIN'],
            'username' => 'admin',
            'divisi' => 'developer',
            'status' => User::STATUS['ACTIVE'],
            'gender' => User::GENDER['MALE'],
            'department' => 'developer',
            'avatar' => '3.jpg',
            'name' => 'admin',
            'email' => 'admin@admin.com',
            'phone' => '81262845980',
            'organisation' => '',
            'password' => '$2y$12$oQ63NRQaAV.L/ugDTealLeXXZR8d8ZM1R21h2/0fMo2zhqcNm72Yy', // admin
        ]);

        DB::table('users')->insert([
            'id' => 2,
            'role' => User::ROLES['USER'],
            'username' => 'user',
            'divisi' => 'developer',
            'status' => User::STATUS['ACTIVE'],
            'gender' => User::GENDER['MALE'],
            'department' => 'developer',
            'avatar' => '2.jpg',
            'name' => 'user',
            'email' => 'user@user.com',
            'phone' => '81262845980',
            'organisation' => '',
            'password' => '$2y$12$oQ63NRQaAV.L/ugDTealLeXXZR8d8ZM1R21h2/0fMo2zhqcNm72Yy', // admin
        ]);
        DB::table('users')->insert([
            'id' => 3,
            'role' => User::ROLES['USER'],
            'username' => 'testing',
            'divisi' => 'testing',
            'status' => User::STATUS['ACTIVE'],
            'gender' => User::GENDER['FEMALE'],
            'department' => 'testing Department',
            'avatar' => '5.jpg',
            'name' => 'Testing',
            'email' => 'testing@testing.com',
            'phone' => '81262845980',
            'organisation' => '',
            'password' => '$2y$12$oQ63NRQaAV.L/ugDTealLeXXZR8d8ZM1R21h2/0fMo2zhqcNm72Yy', // admin
        ]);
    }
}
