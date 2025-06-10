<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DraftThesisSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('draftthesis')->insert([
            [
                'id' => 'draft1',
                'username' => 'platinumuser', // must exist in `profile` table
                'thesislink' => 'https://example.com/thesis1.pdf',
                'number' => 1,
                'startDate' => '2025-01-01',
                'enddate' => '2025-01-15',
                'totalpage' => 50,
                'prepdays' => 14,
                'feedback' => 'Well structured. Good start.',
            ],
            [
                'id' => 'draft1',
                'username' => 'platinumuser',
                'thesislink' => 'https://example.com/thesis2.pdf',
                'number' => 2,
                'startDate' => '2025-02-01',
                'enddate' => '2025-02-15',
                'totalpage' => 60,
                'prepdays' => 10,
                'feedback' => 'Needs more references.',
            ],
        ]);
    }
}
