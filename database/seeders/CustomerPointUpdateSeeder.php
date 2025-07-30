<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CustomerPointUpdateSeeder extends Seeder
{
    public function run(): void
    {
        $customers = DB::table('customers')->get();
        foreach ($customers as $customer) {
            $totalPoint = DB::table('point_history')
                ->where('customer_id', $customer->id)
                ->sum('change');

            // Cập nhật điểm tổng cho customer
            DB::table('customers')
                ->where('id', $customer->id)
                ->update(['point' => $totalPoint]);
        }
    }
}
