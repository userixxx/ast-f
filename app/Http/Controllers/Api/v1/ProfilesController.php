<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ProfilesController extends Controller
{
    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function profile()
    {
        $user = auth()->user();
        if($user) {
            return response($user->load('roles'), 200);
        } else {
            return response(['ErrorMessage' => 'Bad request'], status: 420);
        }
    }
}
