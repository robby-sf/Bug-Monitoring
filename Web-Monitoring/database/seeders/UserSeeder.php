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
            'first_name'   => 'Admin',
            'last_name'    => 'Developer',
            'email'        => 'admin@gmail.com',
            'phone_number' => '+6281231671474',
            'password'     => Hash::make('password123'),
            'role'         => 'admin', 
            'avatar'       => null,
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

        // 3. Lead Developer (Sering dipakai di UI)
        User::create([
            'first_name'   => 'Sarah',
            'last_name'    => 'Chen',
            'email'        => 'sarah.chen@example.com',
            'phone_number' => '+628111222333',
            'password'     => Hash::make('password123'),
            'role'         => 'developer',
            'avatar'       => null,
        ]);

        // 4. Backend Engineer
        User::create([
            'first_name'   => 'Mike',
            'last_name'    => 'Davis',
            'email'        => 'mike.davis@example.com',
            'phone_number' => '+628222333444',
            'password'     => Hash::make('password123'),
            'role'         => 'developer',
            'avatar'       => null,
        ]);

        // 5. Frontend Developer
        User::create([
            'first_name'   => 'Alex',
            'last_name'    => 'Wong',
            'email'        => 'alex.wong@example.com',
            'phone_number' => '+628333444555',
            'password'     => Hash::make('password123'),
            'role'         => 'developer',
            'avatar'       => null,
        ]);

        // 6. Admin Tambahan
        User::create([
            'first_name'   => 'Budi',
            'last_name'    => 'Santoso',
            'email'        => 'budi.admin@example.com',
            'phone_number' => '+628444555666',
            'password'     => Hash::make('password123'),
            'role'         => 'admin',
            'avatar'       => null,
        ]);

        // 7. Developer Tambahan
        User::create([
            'first_name'   => 'Dimas',
            'last_name'    => 'Pratama',
            'email'        => 'dimas.dev@example.com',
            'phone_number' => '+628555666777',
            'password'     => Hash::make('password123'),
            'role'         => 'developer',
            'avatar'       => null,
        ]);

        // 8. Staff CS/Support
        User::create([
            'first_name'   => 'Siti',
            'last_name'    => 'Aminah',
            'email'        => 'siti.support@example.com',
            'phone_number' => '+628666777888',
            'password'     => Hash::make('password123'),
            'role'         => 'staff',
            'avatar'       => null,
        ]);

        // 9. Mobile App Developer
        User::create([
            'first_name'   => 'John',
            'last_name'    => 'Doe',
            'email'        => 'john.mobile@example.com',
            'phone_number' => '+628777888999',
            'password'     => Hash::make('password123'),
            'role'         => 'developer',
            'avatar'       => null,
        ]);

        // 10. QA Engineer (Masuk role staff/tester)
        User::create([
            'first_name'   => 'Jane',
            'last_name'    => 'Smith',
            'email'        => 'jane.qa@example.com',
            'phone_number' => '+628888999000',
            'password'     => Hash::make('password123'),
            'role'         => 'staff',
            'avatar'       => null,
        ]);
    }
}