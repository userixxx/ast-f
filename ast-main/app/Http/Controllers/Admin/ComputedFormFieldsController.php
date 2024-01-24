<?php

namespace App\Http\Controllers\Admin;

use App\Actions\Admin\ComputedFormFields\StoreFormField;
use App\Actions\Admin\ComputedFormFields\UpdateComputedFormField;
use App\Http\Controllers\Controller;
use App\Http\Filters\ComputedFormFieldsFilter;
use App\Http\Requests\Admin\ComputedFormFields\StoreComputedFormFieldRequest;
use App\Http\Requests\Admin\ComputedFormFields\UpdateComputedFormFieldRequest;
use App\Models\ComputedFormField;
use App\Models\FieldCategory;
use App\Models\Form;
use Illuminate\Http\Request;

class ComputedFormFieldsController extends Controller
{
    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index(ComputedFormFieldsFilter $computedFormField)
    {
        $fields = ComputedFormField::filter($computedFormField)->get();

        return view('admin.computed-form-fields.index',[
            'fields' => $fields,
        ]);
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create()
    {
        $units = ComputedFormField::UNITS;
        $forms = Form::all();
        $fieldCategories = FieldCategory::all();

        return view('admin.computed-form-fields.create',[
            'field_units' => $units,
            'forms' => $forms,
            'field_categories' => $fieldCategories,
        ]);
    }

    /**
     * @param StoreComputedFormFieldRequest $request
     * @param StoreFormField $storeFormField
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreComputedFormFieldRequest $request, StoreFormField $storeFormField)
    {
        $validatedRequest = $request->validated();
        $computedFormField = $storeFormField->execute($validatedRequest);
        return redirect()->route('admin.computed-form-fields.index',[
            'just_created' => $computedFormField->id,
        ]);
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
     * @param $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit($id)
    {
        $computedFormField = ComputedFormField::withTrashed()->find($id);
        $units = ComputedFormField::UNITS;
        $forms = Form::all();
        $fieldCategories = FieldCategory::all();

        return view('admin.computed-form-fields.edit',[
            'computed_form_field' => $computedFormField,
            'field_units' => $units,
            'forms' => $forms,
            'field_categories' => $fieldCategories,
        ]);
    }

    /**
     * @param UpdateComputedFormFieldRequest $updateComputedFormFieldRequest
     * @param $id
     * @param UpdateComputedFormField $updateComputedFormField
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(
        UpdateComputedFormFieldRequest $updateComputedFormFieldRequest,
        $id,
        UpdateComputedFormField $updateComputedFormField
    )
    {
        $validatedRequest = $updateComputedFormFieldRequest->validated();
        $computedFormField = $updateComputedFormField->execute($validatedRequest, $id);
        return redirect()->route('admin.computed-form-fields.index');
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $formField = ComputedFormField::find($id);
        if($formField){
            $formField->delete();
        } else {
            ComputedFormField::withTrashed()->find($id)->restore();
        }

        return redirect()->back();
    }
}
