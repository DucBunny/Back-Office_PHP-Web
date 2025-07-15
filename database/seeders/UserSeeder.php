<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Tạo admin user
        User::create([
            'login_id' => 'A0001',
            'name' => 'Administrator',
            'password' => Hash::make('111'),
            'store' => 'A',
            'role' => 'admin',
            'code' => '',
        ]);

        // Tạo thêm 10 user ngẫu nhiên
        User::factory(10)->create();
    }
}
