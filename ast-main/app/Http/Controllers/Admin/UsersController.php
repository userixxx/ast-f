<?php

namespace App\Http\Controllers\Admin;

use App\Actions\Admin\Users\GetUsers;
use App\Actions\Admin\Users\UpdateUser;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Users\GetUsersRequest;
use App\Http\Requests\Admin\Users\UpdateUserRequest;
use App\Models\User;
use App\Services\Admin\RoleService;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class UsersController extends Controller
{
    /**
     * @param GetUsersRequest $request
     * @param GetUsers $getUsers
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index(GetUsersRequest $request, GetUsers $getUsers)
    {
        $users = $getUsers->execute($request);
        return view('admin.users.index',[
            'users' => $users,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return 'users.create';
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return 'users.store';
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return 'users.show';
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit($id, RoleService $roleService)
    {
        $user = User::withTrashed()->find($id);
        $roles = $roleService->all();

        return view('admin.users.edit',[
            'user' => $user,
            'roles' => $roles,
            ]);
    }

    /**
     * @param UpdateUserRequest $request
     * @param $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function update(UpdateUserRequest $request, $id, UpdateUser $updateUser)
    {

        $user = $updateUser->execute($request, $id);

        return redirect()->route('admin.users.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return 'users.destroy';
    }
}
