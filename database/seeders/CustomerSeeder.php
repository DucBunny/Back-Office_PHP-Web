<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class CustomerSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create('ja_JP');
        $customers = [];

        for ($i = 1; $i <= 50; $i++) {
            // Tính tổng điểm từ bảng point_history cho customer này
            $totalPoint = DB::table('point_history')
                ->where('customer_id', $i)
                ->sum('change');

            $customers[] = [
                'gender' => $faker->randomElement([1, 2, 3]),
                'age' => $faker->numberBetween(10, 70),
                'point' => $totalPoint,
                'notes' => $faker->optional(0.7)->realText(200),
                'created_at' => $faker->dateTimeBetween('-2 years', 'now'),
                'updated_at' => now(),
                'updated_by' => $faker->numberBetween(1, 3),
            ];
        }

        DB::table('customers')->insert($customers);
    }
}
