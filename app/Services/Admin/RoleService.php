<?php

namespace App\Services\Admin;

use Spatie\Permission\Models\Role;

class RoleService
{
    public function all()
    {
        $user = auth()->user();

        if ($user->hasRole('super-admin')){
            $roles = Role::where('name', '!=', 'super-admin')->get();
        } elseif ($user->hasRole('admin')){
            $roles = Role::whereNotIn('name', ['admin', 'super-admin'])->get();
        } else {
            $roles = collect([]);
        }

        return $roles;
    }
}
