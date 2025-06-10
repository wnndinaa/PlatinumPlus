<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\Profile\Profile;

class ProfileSeeder extends Seeder
{
    public function run()
    {
        DB::table('profile')->delete();
        $users = [
            [
                'username' => 'platinumuser',
                'password' => '123', // Consider hashing with Hash::make('123') if used in real auth
                'name' => 'Platinum User',
                'email' => 'platinum@example.com',
                'ic' => '900101014321',
                'phonenumber' => '0123456789',
                'role' => 'Platinum',
            ],
            [
                'username' => 'crmpuser',
                'password' => '123',
                'name' => 'CRMP User',
                'email' => 'crmp@example.com',
                'ic' => '900202024321',
                'phonenumber' => '0111222333',
                'role' => 'CRMP',
            ],
            [
                'username' => 'mentoruser',
                'password' => '123',
                'name' => 'Mentor User',
                'email' => 'mentor@example.com',
                'ic' => '900303034321',
                'phonenumber' => '0119988776',
                'role' => 'Mentor',
            ],
            [
                'username' => 'staffuser',
                'password' => '123',
                'name' => 'Staff User',
                'email' => 'staff@example.com',
                'ic' => '900404044321',
                'phonenumber' => '0192233445',
                'role' => 'Staff',
            ],
        ];

        foreach ($users as $user) {
            Profile::create($user);
        }
    }
}
