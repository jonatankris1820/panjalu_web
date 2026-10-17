<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $admins = [
            [
                'email' => env('SUPER_ADMIN_EMAIL'),
                'password' => env('SUPER_ADMIN_PASSWORD'),
                'name' => 'Super Admin',
                'role' => 'super_admin',
            ],
            [
                'email' => env('ADMIN_EMAIL'),
                'password' => env('ADMIN_PASSWORD'),
                'name' => 'Admin',
                'role' => 'admin',
            ],
        ];

        foreach ($admins as $admin) {
            if (
                ! is_string($admin['email'])
                || filter_var($admin['email'], FILTER_VALIDATE_EMAIL) === false
                || ! is_string($admin['password'])
                || $admin['password'] === ''
            ) {
                continue;
            }

            User::firstOrCreate(
                ['email' => $admin['email']],
                [
                    'name' => $admin['name'],
                    'password' => Hash::make($admin['password']),
                    'role' => $admin['role'],
                    'is_active' => true,
                ]
            );
        }
    }
}
