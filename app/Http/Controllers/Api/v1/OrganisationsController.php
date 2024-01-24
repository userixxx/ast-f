<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Models\Api\Organization;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Carbon;

class OrganisationsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $syncDate = $request->input('syncDate');

        $organisations = Organization::withTrashed()
            ->where(function ($query) use ($syncDate) {
                $query->where('created_at', '>', Carbon::createFromTimestamp($syncDate))
                    ->orWhere('updated_at', '>', Carbon::createFromTimestamp($syncDate))
                    ->orWhere('deleted_at', '>', Carbon::createFromTimestamp($syncDate));
            })
            ->get();

        return response()->json($organisations, 200);
    }
    public function updateOrCreate(Request $request, $id)
    {
        if (!$id) {
            $id = $this->generateUuid();
        }

        $organizationData = [
            'name' => $request->input('name'),
            'region_id' => $request->input('region_id'),
            'district_id' => $request->input('district_id'),
            'inn' => $request->input('inn'),
            'creator_id' => $request->input('creator_id'),
            'address' => $request->input('address'),
            'data' => $request->input('data'),
            'deleted_at' => $request->input('deleted_at')
        ];

        $deletedAt = $request->input('deleted_at');
        if ($deletedAt !== null) {
            $organizationData['deleted_at'] = $deletedAt;
        }

        if ($id) {
            $organization = Organization::withTrashed()->updateOrCreate(['id' => $id], $organizationData);
        } else {
            $organization = Organization::withTrashed()->create($organizationData);
        }

        return response(['organization' => $organization], 200);
    }
    private function generateUuid()
    {
        return \Illuminate\Support\Str::uuid()->toString();
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
