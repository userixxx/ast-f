<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Models\Api\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();
        return response($users, 200);
    }
    /**
     * Update or create a user.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateOrCreate(Request $request, $id)
    {
        $user = User::find($id);

        if (!$user) {
            $user = new User();
            $user->id = $id;
        }

        $data = $request->all();

        $user->name = $data['name'] ?? $user->name;
        $user->surname = $data['surname'] ?? $user->surname;
        $user->phone = $data['phone'] ?? $user->phone;
        $user->job_title = $data['job_title'] ?? $user->job_title;
        $user->email = $data['email'] ?? $user->email;

        if (isset($data['password'])) {
            $user->password = Hash::make($data['password']);
        }

        $user->created_at = $data['created_at'] ?? $user->created_at;
        $user->updated_at = $data['updated_at'] ?? $user->updated_at;
        $user->deleted_at = $data['deleted_at'] ?? $user->deleted_at;

        $user->save();

        // Создаем массив с нужными полями пользователя для ответа
        $responseData = [
            'id' => $user->id,
            'name' => $user->name,
            'surname' => $user->surname,
            'phone' => $user->phone,
            'job_title' => $user->job_title,
            'email' => $user->email,
            'password' => $user->password,
            'created_at' => $user->created_at,
            'updated_at' => $user->updated_at,
            'deleted_at' => $user->deleted_at
        ];

        return response(['user' => $responseData], 200);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
