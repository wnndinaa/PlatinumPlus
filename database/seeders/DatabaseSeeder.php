<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            userSeeder::class,
            platinumSeeder::class,
            ExpertDomainSeeder::class,
            draftthesisSeeder::class,
            ExpertPaperSeeder::class,
            PublicationSeeder::class,
            weeklyprogressSeeder::class,
            notificationSeeder::class,
        ]);
    }
}
