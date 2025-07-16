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
            'role' => 'admin',
            'device_code' => 'ADM01',
        ]);

        // Tạo manager users
        User::create([
            'login_id' => 'M0001',
            'name' => 'Manager Salon A',
            'password' => Hash::make('123456'),
            'role' => 'manager',
            'device_code' => 'MG01',
        ]);

        User::create([
            'login_id' => 'M0002',
            'name' => 'Manager Salon B',
            'password' => Hash::make('123456'),
            'role' => 'manager',
            'device_code' => 'MG02',
        ]);

        // Tạo staff users
        for ($i = 1; $i <= 8; $i++) {
            User::create([
                'login_id' => 'S' . str_pad($i, 4, '0', STR_PAD_LEFT),
                'name' => 'Staff ' . $i,
                'password' => Hash::make('123456'),
                'role' => 'staff',
                'device_code' => 'ST' . str_pad($i, 2, '0', STR_PAD_LEFT),
            ]);
        }
    }
}
