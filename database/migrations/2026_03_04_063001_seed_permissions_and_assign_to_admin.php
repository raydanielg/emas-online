<?php

use Illuminate\Database\Migrations\Migration;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

return new class extends Migration
{
    public function up(): void
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // Define permissions
        $permissions = [
            // Schools
            'view schools', 'create schools', 'edit schools', 'delete schools', 'approve schools',
            // Users
            'view users', 'create users', 'edit users', 'delete users', 'suspend users',
            // Results
            'view results', 'publish results', 'unpublish results', 'approve results',
            // Students
            'view students', 'create students', 'edit students', 'delete students', 'import students',
            // Subjects
            'view subjects', 'create subjects', 'edit subjects', 'delete subjects',
            // Analytics
            'view reports', 'view analytics',
            // Payments
            'view payments', 'approve payments', 'manage subscriptions',
            // Communication
            'send sms', 'send email', 'manage announcements',
            // System Settings
            'manage settings', 'manage backup',
            // Security
            'manage roles', 'manage permissions', 'view logs',
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }

        // Assign all permissions to Admin role
        $adminRole = Role::where('name', 'admin')->first();
        if ($adminRole) {
            $adminRole->givePermissionTo(Permission::all());
        }

        // Define a basic user role if it doesn't have specific permissions yet
        $userRole = Role::where('name', 'user')->first();
        if ($userRole) {
            $userRole->givePermissionTo(['view results', 'view students']);
        }
    }

    public function down(): void
    {
        //
    }
};
