<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Models\Api\Report;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class ReportsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $syncDate = $request->input('syncDate');

        $reports = Report::withTrashed()
            ->where(function ($query) use ($syncDate) {
                $query->where('created_at', '>', Carbon::createFromTimestamp($syncDate))
                    ->orWhere('updated_at', '>', Carbon::createFromTimestamp($syncDate))
                    ->orWhere('deleted_at', '>', Carbon::createFromTimestamp($syncDate));
            })
            ->get();

        return response()->json($reports, 200);
    }

    public function updateOrCreate(Request $request, $id)
    {
        if (!$id) {
            $id = $this->generateUuid();
        }

        $reportData = $request->all();

        $conditions = [
            'form_id' => $reportData['form_id'],
            'farm_id' => $reportData['farm_id'],
            'organization_id' => $reportData['organization_id'],
            'user_id' => $reportData['user_id'],
            'date' => $reportData['date'],
        ];

        if ($id) {
            $report = Report::withTrashed()->updateOrCreate(['id' => $id], array_merge($conditions, ['deleted_at' => $reportData['deleted_at'], 'data' => $reportData['data']]));
        } else {
            $report = Report::withTrashed()->updateOrCreate($conditions, array_merge(['deleted_at' => $reportData['deleted_at'], 'data' => $reportData['data']]));
        }

        return response()->json(['report' => $report], 200);
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
