<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Permission;
use App\Models\Role;

class NotificationPermissionSeeder extends Seeder
{
    public function run(): void
    {
        // Create Permission
        $permission = Permission::firstOrCreate(
            ['slug' => 'notification.send'],
            ['name' => 'Send Notifications', 'description' => 'Can send system notifications']
        );

        // Assign to Roles (Admin, HR, Super Admin)
        $roles = ['admin', 'hr', 'super_admin'];
        
        foreach ($roles as $slug) {
            $role = Role::where('slug', $slug)->first();
            if ($role) {
                $role->permissions()->syncWithoutDetaching([$permission->id]);
            }
        }
    }
}
