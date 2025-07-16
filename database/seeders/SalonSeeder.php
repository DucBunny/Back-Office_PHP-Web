<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SalonSeeder extends Seeder
{
    public function run(): void
    {
        $salons = [
            [
                'salon_code' => 'SAL001',
                'type' => 'Cắt tóc',
                'name' => 'Salon Tóc Đẹp Shibuya',
                'furigana' => 'サロン美髪渋谷',
                'address' => '1-1-1 Shibuya, Tokyo',
                'color_plus_point' => 10,
                'perm_plus_point' => 15,
                'status' => true,
                'updated_by' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'salon_code' => 'SAL002',
                'type' => 'Chăm sóc sắc đẹp',
                'name' => 'Beauty Salon Harajuku',
                'furigana' => 'ビューティーサロン原宿',
                'address' => '2-2-2 Harajuku, Tokyo',
                'color_plus_point' => 12,
                'perm_plus_point' => 18,
                'status' => true,
                'updated_by' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'salon_code' => 'SAL003',
                'type' => 'Cắt tóc',
                'name' => 'Hair Studio Shinjuku',
                'furigana' => 'ヘアスタジオ新宿',
                'address' => '3-3-3 Shinjuku, Tokyo',
                'color_plus_point' => 8,
                'perm_plus_point' => 12,
                'status' => true,
                'updated_by' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'salon_code' => 'SAL004',
                'type' => 'Chăm sóc sắc đẹp',
                'name' => 'Luxury Beauty Ginza',
                'furigana' => 'ラグジュアリービューティー銀座',
                'address' => '4-4-4 Ginza, Tokyo',
                'color_plus_point' => 15,
                'perm_plus_point' => 20,
                'status' => true,
                'updated_by' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'salon_code' => 'SAL005',
                'type' => 'Cắt tóc',
                'name' => 'Quick Cut Ikebukuro',
                'furigana' => 'クイックカット池袋',
                'address' => '5-5-5 Ikebukuro, Tokyo',
                'color_plus_point' => 5,
                'perm_plus_point' => 8,
                'status' => true,
                'updated_by' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        DB::table('salons')->insert($salons);
    }
}
