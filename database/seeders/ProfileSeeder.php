<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
<<<<<<< Updated upstream
=======
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
>>>>>>> Stashed changes
use App\Models\Profile\Profile;

class ProfileSeeder extends Seeder
{
    public function run()
    {
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

<<<<<<< Updated upstream
        Profile::create([
            'username'     => 'platinum123',
            'name'         => 'Ali Bin Ahmad',
            'ic'           => '901231015555',
            'email'        => 'ali@example.com',
            'phonenumber'  => '0123456789', // make sure column name is correct
            'role'         => 'platinum',
            'password'     => bcrypt('password123')
        ]);
=======
        foreach ($users as $user) {
            Profile::create($user);
        }
>>>>>>> Stashed changes
    }
}
