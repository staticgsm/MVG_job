<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = [
            ['name' => 'Super Admin', 'slug' => 'super_admin'],
            ['name' => 'Admin', 'slug' => 'admin'],
            ['name' => 'HR', 'slug' => 'hr'],
            ['name' => 'Accountant', 'slug' => 'accountant'],
            ['name' => 'Candidate', 'slug' => 'candidate'],
        ];

        foreach ($roles as $role) {
            \App\Models\Role::create($role);
        }
    }
}
