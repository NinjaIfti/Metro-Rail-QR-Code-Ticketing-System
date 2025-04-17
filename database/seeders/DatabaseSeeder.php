<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create roles if they don't exist
        if (!Role::where('name', 'commuter')->exists()) {
            Role::create(['name' => 'commuter']);
        }

        if (!Role::where('name', 'train_master')->exists()) {
            Role::create(['name' => 'train_master']);
        }

        if (!Role::where('name', 'admin')->exists()) {
            Role::create(['name' => 'admin']);
        }

        // Create admin user if it doesn't exist
        if (!User::where('email', 'admin@metrorail.com')->exists()) {
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
}
