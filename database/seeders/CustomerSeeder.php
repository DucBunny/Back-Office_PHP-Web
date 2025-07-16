<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class CustomerSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create('ja_JP'); // Sử dụng faker tiếng Nhật
        $customers = [];

        for ($i = 1; $i <= 50; $i++) {
            $customers[] = [
                'gender' => $faker->randomElement(['male', 'female', 'other']),
                'age' => $faker->numberBetween(18, 70),
                'category' => $faker->randomElement(['Cắt', 'Nhuộm', 'Uốn', 'Cắt,Nhuộm', 'Cắt,Uốn', 'Nhuộm,Uốn', 'Cắt,Nhuộm,Uốn']),
                'point' => $faker->numberBetween(0, 1000),
                'notes' => $faker->optional(0.7)->realText(200),
                'updated_by' => $faker->numberBetween(1, 3),
                'created_at' => $faker->dateTimeBetween('-2 years', 'now'),
                'updated_at' => now(),
            ];
        }

        DB::table('customers')->insert($customers);
    }
}
