<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Permission;
use App\Models\Role;

class DashboardPermissionSeeder extends Seeder
{
    public function run(): void
    {
        // Define Permissions
        $permissions = [
            'dashboard.view' => 'View Dashboard based on Role',
            'payment.view' => 'View Payment Reports',
        ];

        foreach ($permissions as $slug => $description) {
            Permission::firstOrCreate(['slug' => $slug], ['description' => $description]);
        }

        // Assign to Roles
        $superAdmin = Role::where('slug', 'super_admin')->first();
        if ($superAdmin) {
            $superAdmin->permissions()->syncWithoutDetaching(Permission::whereIn('slug', array_keys($permissions))->pluck('id'));
        }

        $admin = Role::where('slug', 'admin')->first();
        if ($admin) {
            $admin->permissions()->syncWithoutDetaching(Permission::whereIn('slug', ['dashboard.view'])->pluck('id'));
        }

        $hr = Role::where('slug', 'hr')->first();
        if ($hr) {
            $hr->permissions()->syncWithoutDetaching(Permission::whereIn('slug', ['dashboard.view'])->pluck('id'));
        }

        $accountant = Role::where('slug', 'accountant')->first();
        if ($accountant) {
            $accountant->permissions()->syncWithoutDetaching(Permission::whereIn('slug', ['dashboard.view', 'payment.view'])->pluck('id'));
        }
    }
}
