<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Models\Api\FieldTemplate;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class FieldTemplatesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $syncDate = $request->input('syncDate');

        $fieldTemplate = FieldTemplate::withTrashed()
            ->where(function ($query) use ($syncDate) {
                $query->where('created_at', '>', Carbon::createFromTimestamp($syncDate))
                    ->orWhere('updated_at', '>', Carbon::createFromTimestamp($syncDate))
                    ->orWhere('deleted_at', '>', Carbon::createFromTimestamp($syncDate));
            })
            ->get();

        return response()->json($fieldTemplate, 200);
    }

    public function updateOrCreate(Request $request, $id)
    {
        $fields = $request->input('fields');
        $deletedAt = $request->input('deleted_at');

        $templateData = [
            'form_id' => $request->input('form_id'),
            'name' => $request->input('name'),
            'fields' => $fields,
            'deleted_at' => $deletedAt
        ];

        if ($deletedAt !== null) {
            $templateData['deleted_at'] = $deletedAt;
        }

        if ($id) {
            $template = FieldTemplate::withTrashed()->updateOrCreate(['id' => $id], $templateData);
        } else {
            $template = FieldTemplate::withTrashed()->where('name', $request->input('name'))->first();
            if ($template) {
                $template->update($templateData);
            } else {
                $template = FieldTemplate::create($templateData);
            }
        }

        return response()->json($template);
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
