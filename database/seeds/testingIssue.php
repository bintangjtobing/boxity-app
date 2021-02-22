<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;
use App\issue;

class testingIssue extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('issues')->insert([
            'id' => 1,
            'title' => 'Testing Title Issue 1',
            'issue' => 'lorem ipsum lorem ipsum',
            'status' => issue::STATUS['PENDING'],
            'created_by' => 1,
            'approved_by' => 0,
            'assignee' => 3,
            'priority' => issue::PRIORITY['MEDIUM'],
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);
        DB::table('issues')->insert([
            'id' => 2,
            'title' => 'Testing Title Issue 2',
            'issue' => 'lorem ipsum lorem ipsum',
            'status' => issue::STATUS['PENDING'],
            'created_by' => 1,
            'approved_by' => 0,
            'assignee' => 4,
            'priority' => issue::PRIORITY['LOW'],
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);
        DB::table('issues')->insert([
            'id' => 3,
            'title' => 'Testing Title Issue 3',
            'issue' => 'lorem ipsum lorem ipsum',
            'status' => issue::STATUS['OPEN'],
            'created_by' => 2,
            'approved_by' => 0,
            'assignee' => 1,
            'priority' => issue::PRIORITY['HIGH'],
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);
        DB::table('issues')->insert([
            'id' => 4,
            'title' => 'Testing Title Issue 4',
            'issue' => 'lorem ipsum lorem ipsum',
            'status' => issue::STATUS['PENDING'],
            'created_by' => 3,
            'approved_by' => 0,
            'assignee' => 4,
            'priority' => issue::PRIORITY['HIGHEST'],
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);
        DB::table('issues')->insert([
            'id' => 5,
            'title' => 'Testing Title Issue 5',
            'issue' => 'lorem ipsum lorem ipsum',
            'status' => issue::STATUS['OPEN'],
            'created_by' => 4,
            'approved_by' => 0,
            'assignee' => 1,
            'priority' => issue::PRIORITY['LOWEST'],
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);
    }
}
