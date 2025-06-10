<?php

namespace Database\Seeders;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PublicationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
DB::table('publication')->insert([
            'publication_id' => 'publication1',
            'publication_type' => 'Journal Article',
            'publication_file' => 'journal_article.pdf',
            'publication_number' => '1',
            'publication_tittle' => 'Smart Analytics',
            'publication_author' => 'siti',
            'publication_date' => '2025-06-01',
            'publication_DOI' => '10.1038/nphys1170',
            'username' => 'platinumuser',
            'expertPaper_id' => 'paper1',
        ]);
    }
}
