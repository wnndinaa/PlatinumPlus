<?php

namespace Database\Seeders;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class userSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('user')->insert([
            'username' => 'platinumuser',
            'name' => 'ali',
            'ic' => '745683746',
            'email' => 'ali@example.com',
            'phonenumber' => '0123456789',
            'role' => 'platinum',
            'password' => '123',
            'gender' => 'male',
            'citizenship' => 'malaysian',
        ]);
    }
}
