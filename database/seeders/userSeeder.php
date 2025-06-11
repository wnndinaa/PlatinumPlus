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
            [
                'username' => 'platinumuser',
                'name' => 'Ali',
                'ic' => '745683746',
                'email' => 'ali@example.com',
                'phonenumber' => '0123456789',
                'role' => 'Platinum',
                'password' => '123',
                'gender' => 'Male',
                'citizenship' => 'Non-Malaysian',
            ],
            [
                'username' => 'platinumuser2',
                'name' => 'Alia',
                'ic' => '745683706',
                'email' => 'alia@example.com',
                'phonenumber' => '0123456789',
                'role' => 'Platinum',
                'password' => '123',
                'gender' => 'Feamle',
                'citizenship' => 'Malaysian',
            ],
            [
                'username' => 'crmpuser',
                'name' => 'Bella',
                'ic' => '845683746',
                'email' => 'bella@example.com',
                'phonenumber' => '0191234567',
                'role' => 'CRMP',
                'password' => '123',
                'gender' => 'Female',
                'citizenship' => 'Malaysian',
            ],
            [
                'username' => 'mentoruser',
                'name' => 'Charles',
                'ic' => '945683746',
                'email' => 'charles@example.com',
                'phonenumber' => '0187654321',
                'role' => 'Mentor',
                'password' => '123',
                'gender' => 'Male',
                'citizenship' => 'Malaysian',
            ],
            [
                'username' => 'staffuser',
                'name' => 'Diana',
                'ic' => '645683746',
                'email' => 'diana@example.com',
                'phonenumber' => '0175554443',
                'role' => 'Staff',
                'password' => '123',
                'gender' => 'Female',
                'citizenship' => 'Malaysian',
            ],
            [
                'username' => 'staffuser2',
                'name' => 'Lisa',
                'ic' => '64561283746',
                'email' => 'lisa@example.com',
                'phonenumber' => '0175554443',
                'role' => 'Staff',
                'password' => '123',
                'gender' => 'Female',
                'citizenship' => 'Malaysian',
            ],
        ]);
    }
}
