<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class SecurityController extends Controller
{
    public function roles()
    {
        $roles = Role::all();
        return view('admin.security.roles', compact('roles'));
    }

    public function permissions()
    {
        $permissions = Permission::all();
        return view('admin.security.permissions', compact('permissions'));
    }

    public function logs()
    {
        return view('admin.security.logs');
    }
}
