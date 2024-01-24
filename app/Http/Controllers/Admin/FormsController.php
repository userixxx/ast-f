<?php

namespace App\Http\Controllers\Admin;

use App\Actions\Admin\Forms\CreateForm;
use App\Http\Controllers\Controller;
use App\Http\Filters\FormsFilter;
use App\Http\Requests\Admin\Forms\IndexRequest;
use App\Http\Requests\Admin\Forms\StoreFormRequest;
use App\Http\Requests\Admin\Forms\UpdateFormRequest;
use App\Models\FieldCategory;
use App\Models\Form;
use App\Models\FormCategory;
use App\Models\FormField;
use App\Models\Unit;
use Illuminate\Http\Request;

class FormsController extends Controller
{
    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index(FormsFilter $formsFilter)
    {
        $forms = Form::filter($formsFilter)->with(['fields','creator','category'])->paginate(15);
        return view('admin.forms.index', ['forms' => $forms]);
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create()
    {
        $formCategories = FormCategory::all();
        return view('admin.forms.create', ['formCategories' => $formCategories]);
    }

    /**
     * @param StoreFormRequest $request
     * @param CreateForm $createForm
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreFormRequest $request, CreateForm $createForm)
    {
        $validatedRequest = $request->validated();
        $createForm->execute($validatedRequest);
        return redirect()->route('admin.forms.index');
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function show($id)
    {
        $fieldCategories = FieldCategory::all();
        $form = Form::withTrashed()->with('fields')->findOrFail($id);
        $fieldUnits = Unit::all();
        return view('admin.forms.show', ['form' => $form, 'field_categories' => $fieldCategories, 'field_units' => $fieldUnits]);
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit($id)
    {
        $form = Form::withTrashed()->find($id);
        $formCategories = FormCategory::all();
        return view('admin.forms.edit',['form' => $form, 'form_categories' => $formCategories]);
    }

    /**
     * @param UpdateFormRequest $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateFormRequest $request, $id)
    {
        $validatedRequest = $request->validated();
        $form = Form::withTrashed()->find($id);
        $form->update($validatedRequest);
        return redirect()->route('admin.forms.show', ['form' => $form]);
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $form = Form::withTrashed()->find($id);
        if(!$form->deleted_at) {
            $form->delete();
            foreach($form->fields as $field){
                $field->delete();
            }
            foreach($form->reports as $report){
                $report->delete();
            }
            return redirect()->back()->with(['form' => $form]);
        }

        $form->restore();
        foreach($form->fields()->withTrashed()->get() as $field){
            $field->restore();
        }
        foreach($form->reports()->withTrashed()->get() as $report){
            $report->restore();
        }
        return redirect()->back()->with(['form' => $form]);
    }
}
