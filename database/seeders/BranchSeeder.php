<?php

namespace Database\Seeders;

use App\Models\Branch;
use Illuminate\Database\Seeder;

class BranchSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $branches = [
            [
                'branch_name' => 'EXAMINA Kampala Central',
                'location' => 'Kampala',
                'address' => 'Plot 123, Kampala Road, Kampala',
                'phone' => '+256-700-123-456',
                'email' => 'kampala@examinalab.ug',
                'status' => 'active',
            ],
            [
                'branch_name' => 'EXAMINA Entebbe',
                'location' => 'Entebbe',
                'address' => 'Airport Road, Entebbe Municipality',
                'phone' => '+256-700-234-567',
                'email' => 'entebbe@examinalab.ug',
                'status' => 'active',
            ],
            [
                'branch_name' => 'EXAMINA Mbarara',
                'location' => 'Mbarara',
                'address' => 'High Street, Mbarara City',
                'phone' => '+256-700-345-678',
                'email' => 'mbarara@examinalab.ug',
                'status' => 'active',
            ],
            [
                'branch_name' => 'EXAMINA Gulu',
                'location' => 'Gulu',
                'address' => 'Churchill Drive, Gulu City',
                'phone' => '+256-700-456-789',
                'email' => 'gulu@examinalab.ug',
                'status' => 'active',
            ],
            [
                'branch_name' => 'EXAMINA Jinja',
                'location' => 'Jinja',
                'address' => 'Main Street, Jinja City',
                'phone' => '+256-700-567-890',
                'email' => 'jinja@examinalab.ug',
                'status' => 'active',
            ],
        ];

        foreach ($branches as $branch) {
            Branch::create($branch);
        }

        $this->command->info('Branches created successfully!');
    }
}
