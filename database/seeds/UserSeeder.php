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
            'cover' => '3.jpg',
            'name' => 'admin',
            'email' => 'admin@admin.com',
            'phone' => '81262845980',
            'organisation' => '',
            'password' => '$2y$12$oQ63NRQaAV.L/ugDTealLeXXZR8d8ZM1R21h2/0fMo2zhqcNm72Yy', // admin
            'logip' => '-',
            'lastLogin' => '-',
        ]);

        DB::table('users')->insert([
            'id' => 2,
            'role' => User::ROLES['USER'],
            'username' => 'usertesting',
            'divisi' => 'developer',
            'status' => User::STATUS['ACTIVE'],
            'gender' => User::GENDER['MALE'],
            'department' => 'developer',
            'avatar' => '2.jpg',
            'cover' => '2.jpg',
            'name' => 'User Testing',
            'email' => 'user@user.com',
            'phone' => '81262845980',
            'organisation' => '',
            'password' => '$2y$12$oQ63NRQaAV.L/ugDTealLeXXZR8d8ZM1R21h2/0fMo2zhqcNm72Yy', // admin
            'logip' => '-',
            'lastLogin' => '-',
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
            'cover' => '5.jpg',
            'name' => 'Testing',
            'email' => 'testing@testing.com',
            'phone' => '81262845980',
            'organisation' => '',
            'password' => '$2y$12$oQ63NRQaAV.L/ugDTealLeXXZR8d8ZM1R21h2/0fMo2zhqcNm72Yy', // admin
            'logip' => '-',
            'lastLogin' => '-',
        ]);
        DB::table('users')->insert([
            'id' => 4,
            'role' => User::ROLES['HEAD'],
            'username' => 'head',
            'divisi' => 'developer',
            'status' => User::STATUS['ACTIVE'],
            'gender' => User::GENDER['FEMALE'],
            'department' => 'testing Department',
            'avatar' => '4.jpg',
            'cover' => '4.jpg',
            'name' => 'Head',
            'email' => 'head@head.com',
            'phone' => '81262845980',
            'organisation' => '',
            'password' => '$2y$12$oQ63NRQaAV.L/ugDTealLeXXZR8d8ZM1R21h2/0fMo2zhqcNm72Yy', // admin
            'logip' => '-',
            'lastLogin' => '-',
        ]);
        DB::table('users')->insert([
            'id' => 5,
            'role' => User::ROLES['IT'],
            'username' => 'it',
            'divisi' => 'developer',
            'status' => User::STATUS['ACTIVE'],
            'gender' => User::GENDER['MALE'],
            'department' => 'testing Department',
            'avatar' => '1.jpg',
            'cover' => '1.jpg',
            'name' => 'IT',
            'email' => 'it@it.com',
            'phone' => '81262845980',
            'organisation' => '',
            'password' => '$2y$12$oQ63NRQaAV.L/ugDTealLeXXZR8d8ZM1R21h2/0fMo2zhqcNm72Yy', // admin
            'logip' => '-',
            'lastLogin' => '-',
        ]);
        DB::table('users')->insert([
            'id' => 6,
            'role' => User::ROLES['HRDGA'],
            'username' => 'hrdga',
            'divisi' => 'developer',
            'status' => User::STATUS['ACTIVE'],
            'gender' => User::GENDER['FEMALE'],
            'department' => 'testing Department',
            'avatar' => '6.jpg',
            'cover' => '6.jpg',
            'name' => 'HRD & GA',
            'email' => 'hrdga@hrdga.com',
            'phone' => '81262845980',
            'organisation' => '',
            'password' => '$2y$12$oQ63NRQaAV.L/ugDTealLeXXZR8d8ZM1R21h2/0fMo2zhqcNm72Yy', // admin
            'logip' => '-',
            'lastLogin' => '-',
        ]);
    }
}
