<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Database\Seeder;

class JobPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [
            ['name' => 'Create Job', 'slug' => 'job.create', 'description' => 'Can create new job posts'],
            ['name' => 'Edit Job', 'slug' => 'job.edit', 'description' => 'Can edit existing job posts'],
            ['name' => 'View Job', 'slug' => 'job.view', 'description' => 'Can view job posts details'],
            ['name' => 'View Profile', 'slug' => 'profile.view', 'description' => 'Can view candidate profile'],
            ['name' => 'Edit Profile', 'slug' => 'profile.edit', 'description' => 'Can edit candidate profile'],
            ['name' => 'Apply Job', 'slug' => 'job.apply', 'description' => 'Can apply for jobs'],
            ['name' => 'View Applications', 'slug' => 'application.view', 'description' => 'Can view job applications'],
            ['name' => 'Manage Applications', 'slug' => 'application.manage', 'description' => 'Can update application status'],
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['slug' => $permission['slug']], $permission);
        }

        // Assign to Roles
        $superAdmin = Role::where('slug', 'super_admin')->first();
        $admin = Role::where('slug', 'admin')->first();
        $hr = Role::where('slug', 'hr')->first();
        // Check if candidate role exists, if not create it (optional, but good practice if not guaranteed)
        $candidate = Role::firstOrCreate(['slug' => 'candidate'], ['name' => 'Candidate']);

        $allPermissions = Permission::whereIn('slug', ['job.create', 'job.edit', 'job.view', 'application.view', 'application.manage'])->get();
        $viewPermission = Permission::where('slug', 'job.view')->get();
        $hrPermissions = Permission::whereIn('slug', ['job.view', 'application.view', 'application.manage'])->get();
        $candidatePermissions = Permission::whereIn('slug', ['profile.view', 'profile.edit', 'job.apply'])->get();

        if ($superAdmin) {
            $superAdmin->permissions()->syncWithoutDetaching($allPermissions);
        }

        if ($admin) {
            $admin->permissions()->syncWithoutDetaching($allPermissions);
        }

        if ($hr) {
            $hr->permissions()->syncWithoutDetaching($hrPermissions);
        }

        if ($candidate) {
            $candidate->permissions()->syncWithoutDetaching($candidatePermissions);
        }
    }
}
