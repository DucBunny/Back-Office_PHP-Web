<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class CardSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create('ja_JP');
        $cards = [];

        for ($i = 1; $i <= 100; $i++) {
            $is_cut = $faker->boolean(70);
            $is_color = $faker->boolean(40);
            $is_perm = $faker->boolean(30);

            $point = 0;
            if ($is_cut) $point += 5;
            if ($is_color) $point += $faker->numberBetween(8, 15);
            if ($is_perm) $point += $faker->numberBetween(10, 20);

            $createdAt = $faker->dateTimeBetween('-1 year', 'now');
            // visit_date là một ngày trước hoặc trùng với created_at
            $visitDate = $faker->dateTimeBetween('-2 years', $createdAt);

            $cards[] = [
                'salon_id' => $faker->numberBetween(1, 5),
                'customer_id' => $faker->numberBetween(1, 50),
                'is_cut' => $is_cut,
                'is_color' => $is_color,
                'color_note' => $is_color ? $faker->optional(0.8)->realText(100) : null,
                'is_perm' => $is_perm,
                'perm_note' => $is_perm ? $faker->optional(0.8)->realText(100) : null,
                'memo' => $faker->optional(0.6)->realText(300),
                'point' => $point,
                'updated_by' => $faker->numberBetween(1, 11),
                'created_at' => $createdAt,
                'updated_at' => now(),
                'visit_date' => $visitDate,
            ];
        }

        DB::table('cards')->insert($cards);
    }
}
