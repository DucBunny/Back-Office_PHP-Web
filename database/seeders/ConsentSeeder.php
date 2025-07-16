<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ConsentSeeder extends Seeder
{
    public function run(): void
    {
        $consents = [
            [
                'title' => 'Điều khoản sử dụng dịch vụ',
                'description' => 'Khách hàng đồng ý với các điều khoản và điều kiện sử dụng dịch vụ của salon.',
                'status' => true,
                'date' => '2025-01-01',
                'updated_by' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Chính sách bảo mật thông tin',
                'description' => 'Khách hàng đồng ý với việc thu thập, xử lý và sử dụng thông tin cá nhân theo chính sách bảo mật.',
                'status' => true,
                'date' => '2025-01-01',
                'updated_by' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Nhận thông báo khuyến mại',
                'description' => 'Khách hàng đồng ý nhận các thông báo về chương trình khuyến mại, ưu đãi qua email/SMS.',
                'status' => true,
                'date' => '2025-01-01',
                'updated_by' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Chia sẻ dữ liệu với đối tác',
                'description' => 'Khách hàng đồng ý với việc chia sẻ dữ liệu cá nhân với các đối tác kinh doanh.',
                'status' => false,
                'date' => '2025-01-01',
                'updated_by' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Sử dụng hình ảnh cho mục đích marketing',
                'description' => 'Khách hàng đồng ý với việc sử dụng hình ảnh của mình trong các hoạt động marketing của salon.',
                'status' => true,
                'date' => '2025-01-01',
                'updated_by' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        DB::table('consents')->insert($consents);
    }
}
