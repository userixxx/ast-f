<?php

namespace App\Http\Controllers\Specialist;

use App\Actions\Specialist\Reports\UpdateReport;
use App\Http\Controllers\Controller;
use App\Http\Filters\ReportsFilter;
use App\Http\Requests\Specialist\Report\CreateReportRequest;
use App\Http\Requests\Specialist\Report\UpdateReportRequest;
use App\Models\Farm;
use App\Models\FieldCategory;
use App\Models\Form;
use App\Models\FormField;
use App\Models\Report;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class ReportsController extends Controller
{
    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index(ReportsFilter $reportsFilter)
    {
        $reports = Report::with(['farm','form','organization','creator'])->filter($reportsFilter)->whereHas('form', function($query){
            return $query->withoutTrashed();
        })->orderBy('created_at', 'desc')->paginate(15);

        return view('specialist.reports.index', ['reports' => $reports]);
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\RedirectResponse
     */
    public function create()
    {
        $this->formId = session()->get('form_id') ?? Form::first()?->id;
        $this->farmId = session()->get('farm_id') ?? null;

        if (!$this->formId) {
            return redirect()->back()->withErrors(['msg' => "Нет форм для создания отчёта"]);
        }

        return view('specialist.reports.create', ['form_id' => $this->formId, 'farm_id' => $this->farmId]);
    }


    /**
     * @param CreateReportRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(CreateReportRequest $request)
    {
        $validatedRequest = $request->validated();
        $validatedRequest['user_id'] = auth()->id();

        DB::transaction(function() use ($request, $validatedRequest){

            $report = Report::create($validatedRequest);


            if ($report) {
                if ($request->hasFile('files')) {
                    $report->addMultipleMediaFromRequest(['files'])
                        ->each(function ($fileAdder) {
                            $fileAdder->toMediaCollection('reports');
                        });
                }
                return redirect()->route('specialist.reports.index')->with('success', 'Отчёт удачно сохранён!');
            }

        });

        return redirect()->route('specialist.reports.index')->withErrors('message', 'Ошибка при сохраниении');
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function show($id)
    {
        $report = Report::with(['organization.region', 'organization.district', 'farm.region', 'farm.district', 'media'])->withTrashed()->find($id);
        $formFields = FormField::where('form_id', $report?->form_id)->orderBy("number")->get();
        return view('specialist.reports.show', ['report' => $report, 'formFields' => $formFields]);
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit($id)
    {
        $report = Report::withTrashed()->find($id);
        $formFields = FormField::where('form_id', $report->form_id)->get()->groupBy('field_category_id');
        $fieldCategories = FieldCategory::all();
        $colors = FieldCategory::CATEGORY_COLORS;

        return view('specialist.reports.edit', [
            'report' => $report,
            'formFields' => $formFields,
            'fieldCategories' => $fieldCategories,
            'colors' => $colors]);
    }

    /**
     * @param UpdateReportRequest $request
     * @param $id
     * @param UpdateReport $updateReport
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateReportRequest $request, $id, UpdateReport $updateReport)
    {
        $report = Report::withTrashed()->find($id);
        $validatedRequest = $request->validated();

        $result = $updateReport->execute($validatedRequest, $report);
        if ($result) {
            if ($request->hasFile('files')) {
                $fileAdders = $report->addMultipleMediaFromRequest(['files'])
                    ->each(function ($fileAdder) {
                        $fileAdder->toMediaCollection('reports');
                    });
            }
            $mediaItems = $validatedRequest['media_items'] ?? [];
            foreach ($mediaItems as $key => $item) {
                if ($item) {
                    Media::find($item)->delete();
                }
            }
        }
        return redirect()->route('specialist.reports.show', ['report' => $report]);
    }


    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public
    function destroy($id)
    {
        $report = Report::find($id);
        if ($report) {
            $report->delete();
            return redirect()->back()->with(['msg' => 'Отчёт удалён']);
        }
        $report = Report::withTrashed()->find($id);
        $report->restore();

        return redirect()->back()->with(['msg' => 'Отчёт восстановлен']);

    }

    public function deleteFile($id)
    {
        $media = Media::find($id);
        if($media){
            $media->delete();
            return redirect()->back()->with(['message' => 'Файл успешно удалён']);
        }
        return redirect()->back()->withErrors(['msg' => 'Файл не найден']);
    }

}
