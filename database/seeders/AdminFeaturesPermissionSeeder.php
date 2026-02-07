<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdminFeaturesPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [
            // Candidate Management
            ['name' => 'View Candidates', 'slug' => 'candidate.view', 'description' => 'Can view candidate list'],
            ['name' => 'Create Candidates', 'slug' => 'candidate.create', 'description' => 'Can create candidates'],
            ['name' => 'Edit Candidates', 'slug' => 'candidate.edit', 'description' => 'Can edit candidates'],
            ['name' => 'Delete Candidates', 'slug' => 'candidate.delete', 'description' => 'Can delete candidates'],
            
            // Subscription Management
            ['name' => 'View Subscription Plans', 'slug' => 'subscription_plan.view', 'description' => 'Can view subscription plans'],
            ['name' => 'Create Subscription Plans', 'slug' => 'subscription_plan.create', 'description' => 'Can create subscription plans'],
            ['name' => 'Edit Subscription Plans', 'slug' => 'subscription_plan.edit', 'description' => 'Can edit subscription plans'],
            ['name' => 'Delete Subscription Plans', 'slug' => 'subscription_plan.delete', 'description' => 'Can delete subscription plans'],
        ];

        foreach ($permissions as $perm) {
            $permission = \App\Models\Permission::firstOrCreate(
                ['slug' => $perm['slug']],
                ['name' => $perm['name'], 'description' => $perm['description']]
            );
        }

        // Assign to Admin and Super Admin
        $admin = \App\Models\Role::where('slug', 'admin')->first();
        $superAdmin = \App\Models\Role::where('slug', 'super_admin')->first();

        $allPermissions = \App\Models\Permission::whereIn('slug', array_column($permissions, 'slug'))->get();

        if ($admin) {
            $admin->permissions()->syncWithoutDetaching($allPermissions->pluck('id'));
        }

        if ($superAdmin) {
            $superAdmin->permissions()->syncWithoutDetaching($allPermissions->pluck('id'));
        }
    }
}
