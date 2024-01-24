<?php

namespace App\Http\Controllers\Specialist;

use App\Http\Controllers\Controller;
use App\Models\Farm;
use App\Models\FieldCategory;
use App\Models\FormField;
use App\Models\Report;
use Asantibanez\LivewireCharts\Models\ColumnChartModel;
use Illuminate\Http\Request;

class FarmsReportsController extends Controller
{
    /**
     * @param Farm $farm
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index(Farm $farm)
    {
        $reports = Report::where('farm_uuid', $farm->uuid)->with(['form','farm','organization','creator'])->paginate(15);
        $formIds = $reports->pluck('form_id')->unique();
//        $formFields = FormField::whereIn('form_id', $formIds)->orderBy('field_category_id')->get()->groupBy('form_id');
//
//        $formFields = $formFields->map(function($item){
//            return $item->sortBy(function($subitem){
//                return $subitem->number ?? PHP_INT_MAX;
//            });
//        });


        $colors = FieldCategory::CATEGORY_COLORS;

        return view('specialist.farms.reports.index',[
            'farm' => $farm,
            'reports' => $reports,
//            'formFields' => $formFields,
            'colors' => $colors,
        ]);
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
