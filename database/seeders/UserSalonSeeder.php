<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSalonSeeder extends Seeder
{
    public function run(): void
    {
        $userSalons = [
            // Manager 1 quản lý salon 1, 2, 3, 4, 5
            [
                'user_id' => 2,
                'salon_id' => 1,
                'updated_by' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 2,
                'salon_id' => 2,
                'updated_by' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 2,
                'salon_id' => 3,
                'updated_by' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 2,
                'salon_id' => 4,
                'updated_by' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 2,
                'salon_id' => 5,
                'updated_by' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // Manager 2 quản lý salon 6, 7, 8, 9, 10
            [
                'user_id' => 3,
                'salon_id' => 6,
                'updated_by' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 3,
                'salon_id' => 7,
                'updated_by' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 3,
                'salon_id' => 8,
                'updated_by' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 3,
                'salon_id' => 9,
                'updated_by' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 3,
                'salon_id' => 10,
                'updated_by' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // Staff làm việc ở các salon
            [
                'user_id' => 4, // Staff 1
                'salon_id' => 1,
                'updated_by' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 5, // Staff 2
                'salon_id' => 1,
                'updated_by' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 6, // Staff 3
                'salon_id' => 2,
                'updated_by' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 7, // Staff 4
                'salon_id' => 3,
                'updated_by' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 8, // Staff 5
                'salon_id' => 4,
                'updated_by' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 9, // Staff 6
                'salon_id' => 4,
                'updated_by' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 10, // Staff 7
                'salon_id' => 5,
                'updated_by' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        DB::table('user_salon')->insert($userSalons);
    }
}
