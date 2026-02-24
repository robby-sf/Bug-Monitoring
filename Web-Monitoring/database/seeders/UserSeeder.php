<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        // 1. Akun Admin Utama
        User::create([
            'first_name'   => 'admin',
            'last_name'    => 'Developer',
            'email'        => 'admin@gmail.com',
            'phone_number' => '+6281231671474', // Gunakan format string dengan kode negara
            'password'     => Hash::make('password123'),
            'role'         => 'admin', // Gunakan lowercase agar konsisten dengan controller
            'avatar'       => null,    // Default null jika belum ada foto
        ]);

        // 2. Akun Staff/Tester
        User::create([
            'first_name'   => 'Staff',
            'last_name'    => 'Testing',
            'email'        => 'staff@example.com',
            'phone_number' => '+628999888777',
            'password'     => Hash::make('password123'),
            'role'         => 'staff',
            'avatar'       => null,
        ]);
    }
}