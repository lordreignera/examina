<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class SuperAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create super admin user only if it doesn't exist
        $admin = User::firstOrCreate(
            ['email' => 'admin@labtest.com'],
            [
                'name' => 'Super Administrator',
                'password' => Hash::make('admin123'),
                'is_admin' => true,
            ]
        );

        if ($admin->wasRecentlyCreated) {
            $this->command->info('Super Admin created successfully!');
        } else {
            $this->command->info('Super Admin already exists!');
        }
        
        $this->command->info('Email: admin@labtest.com');
        $this->command->info('Password: admin123');
    }
}
