<?php

namespace App\Actions\Admin\Users;

use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

class GetUsers
{
    public function execute($request)
    {
        if($request->select == 'withoutTrashed' ) {
            $users = User::with('roles')->get();
        } elseif($request->select == 'trashed' ){
            $users = User::onlyTrashed()->with('roles')->get();
        } else {
            $users = User::withTrashed()->with('roles')->get();
        }

        return $this->filterUsers($users);
    }

    private function filterUsers(Collection $users)
    {
        $user = auth()->user();

        if($user->hasRole('super-admin')){
            return $users->where('id', '!=', $user->id);
        } elseif($user->hasRole('admin')){
//            TODO: доделать это место. Выводить только тех кто не админ и суперадмин.
            return $users->filter(function($item){
                return !$item->hasRole('admin');
            });
        }
    }
}
