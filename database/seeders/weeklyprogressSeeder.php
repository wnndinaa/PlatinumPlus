<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class weeklyprogressSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('weeklyprogress')->insert([
            'id' => 'progress1',
            'username' => 'platinumuser',
            'startDate' => '2025-06-01',
            'endDate' => '2025-06-30',
            'progressinfo' => 'Completed chapter 2 draft and started literature review for chapter 3.',
            'feedback' => 'Good progress, keep refining the literature review section.',
            'created_at' => now()->setTimezone('Asia/Kuala_Lumpur'),
            'updated_at' => now()->setTimezone('Asia/Kuala_Lumpur'),
        ]);
    }
}
