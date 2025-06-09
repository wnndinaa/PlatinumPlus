<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Profile\Profile;
use Illuminate\Support\Facades\Hash;

class ProfileSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        Profile::create([
            'username'     => 'platinum123',
            'name'         => 'Ali Bin Ahmad',
            'ic'           => '901231015555',
            'email'        => 'ali@example.com',
            'phonenumber'  => '0123456789', // make sure column name is correct
            'role'         => 'platinum',
            'password'     => 'test123'
        ]);
    }
}
