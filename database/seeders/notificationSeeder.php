<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;


class notificationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('notification')->insert([
            'notification_id' => 'notif1',
            'from_username'   => 'crmpuser',
            'to_username'     => 'platinumuser',
            'expertPaper_id'  => 'paper1', // Ensure this paper exists
            'message'         => 'Kindly update your paper with the correct publication details.',
            'is_read'         => false,
            'created_at'      => Carbon::now(),
            'updated_at'      => Carbon::now(),
        ]);
    }
}
