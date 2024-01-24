<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\v1\Regions\IndexRequest;
use App\Models\Api\Region;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Carbon\Carbon;

class RegionsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $syncDate = $request->input('syncDate');

        $regions = Region::where(function ($query) use ($syncDate) {
            if ($syncDate) {
                $query->where(function ($query) use ($syncDate) {
                    $query->where('created_at', '>', Carbon::createFromTimestamp($syncDate))
                        ->orWhere('updated_at', '>', Carbon::createFromTimestamp($syncDate));
                });
            }
        })->get();

        return response()->json(['regions' => $regions]);
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
     * Update or create the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateOrCreate(Request $request, $id)
    {
        $regionData = [
            'name' => $request->input('name'),
        ];

        $region = Region::updateOrCreate(['id' => $id], $regionData);

        return response(['region' => $region]);
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
