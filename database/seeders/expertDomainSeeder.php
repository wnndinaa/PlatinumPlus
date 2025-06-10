<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ExpertDomainSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('expert_domain')->insert([
            'username' => 'platinumuser', // Must exist in profile table
            'expert_id' => 'expert1',
            'expert_name' => 'Aminah',
            'expert_university' => 'Universiti Malaysia Pahang',
            'expert_occupation' => 'Senior Lecturer',
            'expert_phoneNum' => '0123344556',
            'expert_email' => 'aminah@gmail.com',
            'domain_expertise' => 'Data Analytics and Visualization',
        ]);
}
}