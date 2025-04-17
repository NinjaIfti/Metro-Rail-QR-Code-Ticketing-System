<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create admin user
        $admin = User::create([
            'name' => 'Admin User',
            'email' => 'admin@metrorail.com',
            'password' => Hash::make('admin123'),
            'email_verified_at' => now(),
        ]);

        // Assign admin role
        $admin->assignRole('admin');
    }
}
