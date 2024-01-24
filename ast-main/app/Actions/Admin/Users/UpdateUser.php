<?php

namespace App\Actions\Admin\Users;

use App\Models\User;

class UpdateUser
{
    public function execute($request, $id)
    {
        $user = User::withTrashed()->with('roles')->find($id);
        $validatedRequest = $request->validated();

        $result = $user->update($validatedRequest);


        if($result){
            $user->syncRoles($validatedRequest['roles'] ?? []);
        }

        return $user;
    }
}
