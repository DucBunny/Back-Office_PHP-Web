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
            do {
                $is_cut = $faker->boolean(70);
                $is_color = $faker->boolean(40);
                $is_perm = $faker->boolean(30);
            } while (!$is_cut && !$is_color && !$is_perm);

            $salon_id = $faker->numberBetween(1, 10);
            $salon = DB::table('salons')->where('id', $salon_id)->first();

            $point = 0;
            if ($is_color && $salon) $point += $salon->color_plus_point;
            if ($is_perm && $salon) $point += $salon->perm_plus_point;

            $createdAt = $faker->dateTimeBetween('-1 year', 'now');
            $visitDate = $faker->dateTimeBetween('-2 years', $createdAt); // visit_date là một ngày trước hoặc trùng với created_at

            $cards[] = [
                'salon_id' => $salon_id,
                'customer_id' => $faker->numberBetween(1, 50),
                'is_cut' => $is_cut,
                'is_color' => $is_color,
                'color_note' => $is_color ? $faker->optional(0.8)->realText(100) : null,
                'is_perm' => $is_perm,
                'perm_note' => $is_perm ? $faker->optional(0.8)->realText(100) : null,
                'practitioner' => $faker->name(),
                'memo' => $faker->optional(0.6)->realText(300),
                'point' => $point,
                'visit_date' => $visitDate,
                'created_at' => $createdAt,
                'updated_at' => now(),
                'updated_by' => $faker->numberBetween(1, 3),
            ];
        }

        DB::table('cards')->insert($cards);
    }
}
