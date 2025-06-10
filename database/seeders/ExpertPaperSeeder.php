<?php

namespace Database\Seeders;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ExpertPaperSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('expert_paper')->insert([
            'expertPaper_id' => 'paper1',
            'paper_DOI' => '10.1038/nphys1170',
            'paper_author' => 'siti',
            'paper_date' => '2025-06-01',
            'expert_id' => 'expert1',
            'username' => 'platinumuser', // Must exist in profile table
        ]);
    }
}
