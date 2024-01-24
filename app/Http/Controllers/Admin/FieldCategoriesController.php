<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\FieldCategories\StoreFieldCategory;
use App\Http\Requests\Admin\FieldCategories\UpdateFieldCategory;
use App\Models\FieldCategory;
use Illuminate\Http\Request;

class FieldCategoriesController extends Controller
{
    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        $fieldCategories = FieldCategory::all();
        return view('admin.field-categories.index',[
            'field_categories' => $fieldCategories,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.field-categories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreFieldCategory $request)
    {
        $validatedRequest = $request->validated();

        FieldCategory::firstOrCreate(['name' => $validatedRequest['name']]);
        return redirect()->route('admin.field-categories.index')->with(['successMsg'=>'Категория успешно создана']);
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
        $fieldCategory = FieldCategory::find($id);
        return view('admin.field-categories.edit',[
            'field_category' => $fieldCategory,
        ]);
    }

    /**
     * @param UpdateFieldCategory $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateFieldCategory $request, $id)
    {
        $validatedRequest = $request->validated();

        $fieldCategory = FieldCategory::find($id);
        $fieldCategory->update(['name' => $validatedRequest['name']]);

        return redirect()->route('admin.field-categories.index')
            ->with(['successMsg'=>'Категория успешно обновлена']);
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
