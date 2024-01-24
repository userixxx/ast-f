<?php

namespace App\Http\Controllers\General;

use App\Actions\General\Profiles\UpdateProfile;
use App\Http\Controllers\Controller;
use App\Http\Requests\General\Profiles\UpdateProfileRequest;
use Illuminate\Http\Request;

class ProfilesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
     * @param $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function show($id)
    {
        $user = auth()->user();
        return view('general.profiles.show',[
            'user' => $user,
        ]);
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit($id)
    {
        $user = auth()->user();
        return view('general.profiles.edit',['user' => $user]);
    }

    /**
     * @param UpdateProfileRequest $request
     * @param $id
     * @param UpdateProfile $updateProfile
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateProfileRequest $request, $id, UpdateProfile $updateProfile)
    {
        $validatedRequest = $request->validated();
        $user = auth()->user();
        $result = $updateProfile->execute($validatedRequest, $user);
        return redirect()->route('general.profiles.show', [
            'profile' => $user,
        ]);
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
