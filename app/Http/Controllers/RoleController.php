<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Role;
use App\Models\Permission;
use Illuminate\Validation\Rule;

class RoleController extends Controller
{
    public function index()
    {
        $roles = Role::withCount('users')->get();
        return view('admin.roles.index', compact('roles'));
    }

    public function create()
    {
        return view('admin.roles.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:roles',
        ]);

        Role::create($request->all());

        return redirect()->route('roles.index')->with('success', 'Role created successfully.');
    }

    public function edit(Role $role)
    {
        return view('admin.roles.edit', compact('role'));
    }

    public function update(Request $request, Role $role)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'slug' => ['required', 'string', 'max:255', Rule::unique('roles')->ignore($role->id)],
        ]);

        // Prevent editing super_admin slug
        if ($role->slug === 'super_admin' && $request->slug !== 'super_admin') {
            return back()->with('error', 'Cannot change the slug of Super Admin role.');
        }

        $role->update($request->all());

        return redirect()->route('roles.index')->with('success', 'Role updated successfully.');
    }

    public function destroy(Role $role)
    {
        if ($role->slug === 'super_admin') {
            return back()->with('error', 'Cannot delete Super Admin role.');
        }

        if ($role->users()->count() > 0) {
            return back()->with('error', 'Cannot delete role with assigned users.');
        }

        $role->delete();

        return redirect()->route('roles.index')->with('success', 'Role deleted successfully.');
    }

    public function permissions(Role $role)
    {
        $permissions = Permission::all();
        return view('admin.roles.permissions', compact('role', 'permissions'));
    }

    public function updatePermissions(Request $request, Role $role)
    {
        $request->validate([
            'permissions' => 'array',
            'permissions.*' => 'exists:permissions,id',
        ]);

        // Prevent removing critical permissions from super_admin? 
        // For now, we trust super admin knows what they are doing, or we can enforce it.
        // Let's just sync.

        $role->permissions()->sync($request->permissions);

        return redirect()->route('roles.index')->with('success', 'Permissions updated for role successfully.');
    }
}
