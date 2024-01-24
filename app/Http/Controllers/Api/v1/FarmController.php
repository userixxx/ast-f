<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Api\Farm;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;


class FarmController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        $syncDate = $request->input('syncDate');

        $farms = Farm::withTrashed()
            ->where(function ($query) use ($syncDate) {
                if ($syncDate) {
                    $query->where(function ($query) use ($syncDate) {
                        $query->where('created_at', '>', Carbon::createFromTimestamp($syncDate))
                            ->orWhere('updated_at', '>', Carbon::createFromTimestamp($syncDate))
                            ->orWhere('deleted_at', '>', Carbon::createFromTimestamp($syncDate));
                    });
                }
            })
            ->get();

        return response()->json($farms, 200);
    }





    public function updateOrCreate(Request $request, $id)
    {
        if (!$id) {
            $id = $this->generateUuid();
        }

        $farmData = [
            'name' => $request->input('name'),
            'organization_id' => $request->input('organization_id') ?? $this->generateUuid(),
            'region_id' => $request->input('region_id'),
            'district_id' => $request->input('district_id'),
            'address' => $request->input('address'),
            'contact_name' => $request->input('contact_name'),
            'contact_job_title' => $request->input('contact_job_title'),
            'contact_value' => $request->input('contact_value'),
            'deleted_at' => $request->input('deleted_at')
        ];

        if ($id) {
            $farm = Farm::withTrashed()->updateOrCreate(['id' => $id], $farmData);
        } else {
            $farm = Farm::withTrashed()->create($farmData);
        }

        return response(['farm' => $farm], 200);
    }

    private function generateUuid()
    {
        return \Illuminate\Support\Str::uuid()->toString();
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
