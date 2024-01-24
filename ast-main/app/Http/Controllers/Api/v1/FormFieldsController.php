<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Models\Api\FormField;
use Illuminate\Http\Request;

class FormFieldsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $formFields = FormField::all();
        return response($formFields, 200);
    }

    public function updateOrCreate(Request $request, $id)
    {
        $formField = FormField::find($id);

        if (!$formField) {
            $formField = new FormField();
            $formField->id = $id;
        }

        $formField->form_id = $request->input('form_id', $formField->form_id);
        $formField->name = $request->input('name', $formField->name);
        $formField->number = $request->input('number', $formField->number);
        $formField->type = $request->input('type', $formField->type);
        $formField->unit = $request->input('unit', $formField->unit);
        $formField->field_category_id = $request->input('field_category_id', $formField->field_category_id);
        $formField->select_fields = $request->input('select_fields', $formField->select_fields);
        $formField->required = $request->input('required', $formField->required);
        $formField->is_numeric = $request->input('is_numeric', $formField->is_numeric);
        $formField->min = $request->input('min', $formField->min);
        $formField->max = $request->input('max', $formField->max);
        $formField->step = $request->input('step', $formField->step);
        $formField->placeholder = $request->input('placeholder', $formField->placeholder);
        $formField->hint = $request->input('hint', $formField->hint);
        $formField->class = $request->input('class', $formField->class);
        $formField->formula = $request->input('formula', $formField->formula);

        $formField->save();

        return response()->json([
            'message' => 'Form field updated or created successfully',
            'data' => $formField
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
