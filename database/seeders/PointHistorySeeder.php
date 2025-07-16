<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PointHistorySeeder extends Seeder
{
    public function run(): void
    {
        $pointHistories = [];

        $types = [
            'Đến cửa hàng',
            'Đổi sản phẩm',
            'Cộng điểm thủ công',
            'Mua sản phẩm',
            'Giới thiệu bạn bè',
            'Sinh nhật',
            'Sự kiện đặc biệt'
        ];

        // Tạo lịch sử điểm cho 50 khách hàng
        for ($customerId = 1; $customerId <= 50; $customerId++) {
            // Mỗi khách hàng có 3-10 lần thay đổi điểm
            $numTransactions = rand(3, 10);

            for ($i = 0; $i < $numTransactions; $i++) {
                $type = $types[array_rand($types)];

                // Xác định số điểm thay đổi dựa trên loại
                switch ($type) {
                    case 'Đến cửa hàng':
                        $change = rand(5, 20); // Cộng 5-20 điểm
                        break;
                    case 'Đổi sản phẩm':
                        $change = -rand(100, 500); // Trừ 100-500 điểm
                        break;
                    case 'Cộng điểm thủ công':
                        $change = rand(10, 100); // Cộng 10-100 điểm
                        break;
                    case 'Mua sản phẩm':
                        $change = rand(20, 200); // Cộng 20-200 điểm
                        break;
                    case 'Giới thiệu bạn bè':
                        $change = rand(50, 150); // Cộng 50-150 điểm
                        break;
                    case 'Sinh nhật':
                        $change = rand(100, 300); // Cộng 100-300 điểm
                        break;
                    case 'Sự kiện đặc biệt':
                        $change = rand(30, 100); // Cộng 30-100 điểm
                        break;
                    default:
                        $change = rand(10, 50);
                }

                $pointHistories[] = [
                    'customer_id' => $customerId,
                    'change' => $change,
                    'type' => $type,
                    'updated_by' => rand(1, 11), // Random user từ 1-11
                    'created_at' => now()->subDays(rand(0, 90))->subHours(rand(0, 23))->subMinutes(rand(0, 59)),
                    'updated_at' => now()->subDays(rand(0, 90))->subHours(rand(0, 23))->subMinutes(rand(0, 59)),
                ];
            }
        }

        // Sắp xếp theo thời gian tạo để có logic hợp lý
        usort($pointHistories, function ($a, $b) {
            return $a['created_at'] <=> $b['created_at'];
        });

        // Insert theo batch để tối ưu performance
        $chunks = array_chunk($pointHistories, 100);
        foreach ($chunks as $chunk) {
            DB::table('point_history')->insert($chunk);
        }
    }
}
