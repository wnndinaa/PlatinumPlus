<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class expertDomainSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('expertDomain')->insert([
            'expert_id' => 'expert1',
            'expert_name' => 'aminah',
            'expert_university' => 'Universiti Malaysia Pahang',
            'expert_occupation' => 'expert_phoneNum',
            'expert_email' => 'aminah@gmail.com',
            'domain_expertise' => 'Data Analytics and Visualization',
        ])
    ;}
}
