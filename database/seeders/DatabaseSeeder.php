<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
            SalonSeeder::class,
            UserSalonSeeder::class,
            CustomerSeeder::class,
            ConsentSeeder::class,
            CustomerConsentSeeder::class,
            PointHistorySeeder::class,
            CardSeeder::class,
        ]);
    }
}
