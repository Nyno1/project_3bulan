<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
        'name' => 'Admin Sekolah',
        'email' => 'admin@sekolah.com',
        'password' => Hash::make('admin123'),
        'role' => 'admin',
    ]);

    User::create([
        'name' => 'PT Tech Solutions',
        'email' => 'partner@company.com',
        'password' => Hash::make('company123'),
        'role' => 'perusahaan',
    ]);
    }
}
