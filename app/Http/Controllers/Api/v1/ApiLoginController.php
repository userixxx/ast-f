<?php

namespace App\Http\Controllers\Api\v1;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ApiLoginController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json([
                'error' => 'The provided credentials are incorrect.'
            ], 401);
        }

        $roles = $user->roles()->pluck('name')->toArray();

        $token = $user->createToken('Access Token')->plainTextToken;

        return response()->json([
            'token' => $token,
            'user' => [
                'id' => $user->id,
                'name' => $user->name,
                'surname' => $user->surname,
                'email' => $user->email,
                'password' => $request->password,
                'phone' => $user->phone,
                'job_title' => $user->job_title,
                'email_verified_at' => $user->email_verified_at,
                'deleted_at' => $user->deleted_at,
                'remember_token' => $user->remember_token,
                'created_at' => $user->created_at,
                'updated_at' => $user->updated_at,
                'roles' => $roles,
            ]
        ], 200);
    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'surname' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8',
            'phone' => 'nullable|string',
            'job_title' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }

        $existingUser = User::where('email', $request->email)->first();

        if ($existingUser) {
            return response()->json(['message' => 'Такой пользователь уже существует'], 409);
        }

        $user = User::create([
            'name' => $request->name,
            'surname' => $request->surname,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'phone' => $request->phone,
            'job_title' => $request->job_title,
        ]);

        $roles = $request->input('roles', []);
        $user->roles()->attach($roles);

        $token = $user->createToken('Access Token')->plainTextToken;

        $user->load('roles');

        return response()->json([
            'token' => $token,
            'user' => [
                'id' => $user->id,
                'name' => $user->name,
                'surname' => $user->surname,
                'email' => $user->email,
                'password' => $request->password,
                'phone' => $user->phone,
                'job_title' => $user->job_title,
                'email_verified_at' => $user->email_verified_at,
                'deleted_at' => $user->deleted_at,
                'remember_token' => $user->remember_token,
                'created_at' => $user->created_at,
                'updated_at' => $user->updated_at,
                'roles' => $user->roles->pluck('name'),
            ]
        ], 201);
    }
}
