<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PointHistorySeeder extends Seeder
{
    public function run(): void
    {
        $pointHistories = [];

        // --- Tạo history type 1 từ card ---
        $cards = DB::table('cards')->get();
        foreach ($cards as $card) {
            if ($card->point > 0) {
                $pointHistories[] = [
                    'customer_id' => $card->customer_id,
                    'change'      => $card->point,
                    'type'        => 1,
                    'updated_by'  => $card->updated_by,
                    'created_at'  => $card->visit_date,
                    'updated_at'  => $card->updated_at,
                ];
            }
        }

        // --- Tạo history type 2, 3 random ---
        for ($customerId = 1; $customerId <= 50; $customerId++) {
            // Tính tổng điểm hiện tại từ các history đã tạo cho customer này
            $currentTotal = 0;
            foreach ($pointHistories as $h) {
                if ($h['customer_id'] === $customerId) {
                    $currentTotal += $h['change'];
                }
            }

            $numTransactions = rand(2, 5);
            for ($i = 0; $i < $numTransactions; $i++) {
                $type = rand(2, 3);

                if ($type == 2) {
                    do {
                        $change = rand(-min($currentTotal, 1000), 1000);
                    } while ($change == 0);
                } else {
                    if ($currentTotal <= 0) {
                        continue;
                    }
                    $change = -rand(1, $currentTotal);
                }

                $pointHistories[] = [
                    'customer_id' => $customerId,
                    'change'      => $change,
                    'type'        => $type,
                    'updated_by'  => rand(1, 3),
                    'created_at'  => now()->subDays(rand(0, 90))->subHours(rand(0, 23))->subMinutes(rand(0, 59)),
                    'updated_at'  => now()->subDays(rand(0, 90))->subHours(rand(0, 23))->subMinutes(rand(0, 59)),
                ];

                $currentTotal += $change;
            }
        }

        // Sắp xếp theo thời gian (cũ -> mới)
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
