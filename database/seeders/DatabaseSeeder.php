<?php

namespace Database\Seeders;


use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
// Create user roles
        Role::firstOrCreate(['name' => 'commuter']);
        Role::firstOrCreate(['name' => 'train_master']);
        Role::firstOrCreate(['name' => 'admin']);

// Assign the admin role to your email
        $admin = User::where('email', 'ifti3061@gmail.com')->first();
        if ($admin) {
            $admin->assignRole('admin');
        } else {
// Create an admin user if not found
            $adminUser = User::create([
                'name' => 'Admin User',
                'email' => 'ifti3061@gmail.com',
                'password' => bcrypt('password123'), // Change the password after login
            ]);
            $adminUser->assignRole('admin');
        }
    }
}
