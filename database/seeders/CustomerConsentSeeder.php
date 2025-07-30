<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CustomerConsentSeeder extends Seeder
{
    public function run(): void
    {
        $customerConsents = [];

        // Giả sử có 50 khách hàng và 5 consents
        for ($customerId = 1; $customerId <= 50; $customerId++) {
            // Mỗi khách hàng sẽ đồng ý với một số consent ngẫu nhiên
            $agreedConsents = [];

            // Consent 1 và 2 (điều khoản và bảo mật) - bắt buộc, hầu hết khách hàng đều đồng ý
            if (rand(1, 100) <= 95) { // 95% đồng ý
                $agreedConsents[] = 1;
            }
            if (rand(1, 100) <= 90) { // 90% đồng ý
                $agreedConsents[] = 2;
            }

            // Consent 3 (nhận khuyến mại) - 70% đồng ý
            if (rand(1, 100) <= 70) {
                $agreedConsents[] = 3;
            }

            // Consent 4 (chia sẻ với đối tác) - 30% đồng ý
            if (rand(1, 100) <= 30) {
                $agreedConsents[] = 4;
            }

            // Consent 5 (sử dụng hình ảnh) - 50% đồng ý
            if (rand(1, 100) <= 50) {
                $agreedConsents[] = 5;
            }

            // Tạo records cho các consent đã đồng ý
            foreach ($agreedConsents as $consentId) {
                $customerConsents[] = [
                    'customer_id' => $customerId,
                    'consent_id' => $consentId,
                    'agreed_at' => now()->subDays(rand(0, 30))->subHours(rand(0, 23))->subMinutes(rand(0, 59)),
                    'created_at' => now(),
                    'updated_at' => now(),
                    'updated_by' => rand(1, 3),
                ];
            }
        }

        // Insert theo batch để tối ưu performance
        $chunks = array_chunk($customerConsents, 100);
        foreach ($chunks as $chunk) {
            DB::table('customer_consent')->insert($chunk);
        }
    }
}
