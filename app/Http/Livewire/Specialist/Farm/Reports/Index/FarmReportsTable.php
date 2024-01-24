<?php

namespace App\Http\Livewire\Specialist\Farm\Reports\Index;

use App\Exports\ReportExport;
use App\Models\Farm;
use App\Models\FieldCategory;
use App\Models\FieldTemplate;
use App\Models\Form;
use App\Models\FormCategory;
use App\Models\FormField;
use App\Models\Report;
use App\Services\Specialist\FormFieldService;
use App\Services\Specialist\ReportService;
use Asantibanez\LivewireCharts\Models\ColumnChartModel;
use Asantibanez\LivewireCharts\Models\LineChartModel;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Maatwebsite\Excel\Facades\Excel;

class FarmReportsTable extends Component
{
    public Farm $farm;
    public array $colors;
    public Collection $reports;
    public Collection $formFields;
    public Form $form;
    public int $formId;
    public Collection $forms;
    public $checkedReports = [];
    public Collection $selectedReports;
    private ReportService $reportService;
    public $dateFrom;
    public $dateTo;
    private ColumnChartModel $columnChartModel;
    private LineChartModel $lineChartModel;
    public $checkedFields = [];
    public $checkedComputedFields = [];
    public Collection $computedFormFields;
    public string $templateName;
    public string $resultMessage;
    public Collection $templates;
    public bool $uncheckedAll = false;

    public $svg;

    protected $listeners = ['postAdded' => 'createAndDownloadPDF'];
    private Farm $farmPDF;
    private string $url;

    public function createAndDownloadPDF($url, $farm, $legend)
    {
        $this->url = $url;
        $legend = str_replace('Helvetica','"DejaVu Sans"',$legend);
        $this->legend = str_replace('absolute','relative',$legend);
        $this->farmPDF = new Farm($farm);
        $pdfContent = PDF::setOptions([
            'isHtml5ParserEnabled' => false,
            'isRemoteEnabled' => true,
            'pdf' => true
        ])
            ->loadView('livewire.specialist.farm.reports.index.partials.download-pdf-document',
                [
                    'legend' => $this->legend,
                    'url' => $this->url,
                    'farm' => $this->farmPDF,
                    'reports' => $this->reports,
                    'formFields' => $this->formFields->where('type', '=', 'number'),
                ])->output();
        return response()->streamDownload(
            fn() => print($pdfContent),
            "filename.pdf"
        );

    }


    public function __construct()
    {
        $this->forms = Form::all();
        $this->formId = Form::first()->id;
        $this->form = $this->forms->first();
        $this->reportService = new ReportService();
        $this->dateFrom = Carbon::now()->subMonth()->format('Y-m-d');
        $this->dateTo = Carbon::now()->format('Y-m-d H:i:s');
        $this->columnChartModel =
            (new ColumnChartModel())
                ->setTitle('График таблицы');

        $this->lineChartModel =
            (new LineChartModel())->setTitle($this->form->name)
                ->addColor('#aa33ff');

        $this->checkedFields = $this->form->fields->pluck('id')->toArray();
        $this->computedFormFields = $this->form->computedFields;
        $this->templates = FieldTemplate::where('form_id', $this->formId)->get();
    }

    public function mount(Farm $farm)
    {
        $this->farm = $farm;
        $this->reports = Report::where('farm_uuid', $farm->uuid)
            ->where('form_id', Form::first()->id)
            ->where('created_at', '>=', $this->dateFrom)
            ->where('created_at', '<=', $this->dateTo)
            ->get();

        $this->formFields = FormField::where('form_id', $this->formId)
            ->orderBy('field_category_id', 'asc')
            ->get();

        $this->computedFormFields = $this->form->computedFields;
        $this->templateName = '';
        $this->resultMessage = '';

    }

    public function showReports()
    {
        $this->reports = Report::where('farm_uuid', $this->farm->uuid)
            ->where('form_id', $this->formId)
            ->where('created_at', '>=', $this->dateFrom)
            ->where('created_at', '<=', $this->dateTo)
            ->get();

        $this->formFields = FormField::where('form_id', $this->formId)->get()->sortBy('field_category_id');
    }

    public function updatedFormId($value)
    {
        $this->reports = Report::where('farm_uuid', $this->farm->uuid)->where('form_id', $this->formId)->get();
        $this->form = Form::find($value);
        $this->formFields = FormField::where('form_id', $this->formId)->get();
        $this->templates = FieldTemplate::where('form_id', $this->formId)->get();
        $this->checkedFields = $this->form->fields->pluck('id')->toArray();
        $this->computedFormFields = $this->form->computedFields;
    }

    public function compareReports()
    {
        $this->selectedReports = Report::whereIn('id', $this->checkedReports)->get();
//        $result = $this->reportService->compareSelectedReports($this->selectedReports, $this->formFields);
        $this->reports = $this->selectedReports;
        $this->formFields = $this->formFields->whereIn('id', $this->checkedFields);
        $this->columnChartModel = $this->getColumnChartModel();
        $this->lineChartModel = $this->getLineChartModel();

    }

    public function resetSelectedReports()
    {
        $this->selectedReports = new Collection([]);
        $this->checkedReports = [];
        $this->checkedFields = $this->form->fields->pluck('id')->toArray();
        $this->formFields = $this->form->fields->whereIn('id', $this->checkedFields);
        $this->reports = Report::where('farm_uuid', $this->farm->uuid)
            ->where('form_id', $this->formId)
            ->where('created_at', '>=', $this->dateFrom)
            ->where('created_at', '<=', $this->dateTo)
            ->get();
        $this->uncheckedAll = false;

    }

    public function resetSelectedReportsWithoutFields()
    {
        $this->selectedReports = new Collection([]);
        $this->checkedReports = [];
        $this->reports = Report::where('farm_uuid', $this->farm->uuid)
            ->where('form_id', $this->formId)
            ->where('created_at', '>=', $this->dateFrom)
            ->where('created_at', '<=', $this->dateTo)
            ->get();

    }

    public function recoverSelectedReports()
    {
        $this->reports = Report::where('farm_uuid', $this?->farm?->uuid)
            ->where('form_id', $this->formId)
            ->where('created_at', '>=', $this->dateFrom)
            ->where('created_at', '<=', $this->dateTo)
            ->get();

    }

    public function render()
    {
        return view('livewire.specialist.farm.reports.index.farm-reports-table', [
            'reports' => $this->reports,
            'formFields' => $this->formFields->sortBy('field_category_id'),
            'form' => $this->form,
            'forms' => $this->forms,
            'formId' => $this->formId,
            'columnChartModel' => $this->columnChartModel,
            'lineChartModel' => $this->lineChartModel,
        ]);
    }

    private function getColumnChartModel()
    {
        $colors = FieldCategory::CATEGORY_COLORS;

        $col = new ColumnChartModel();
        $col->setTitle($this->form->name)->setColumnWidth(10);
        $this->formFields->each(function ($item, $key) use ($col, $colors) {
            if ($item->type == 'number') {
                foreach ($this->reports as $key => $report) {
                    $title = $item->name . " " . $report->date;
                    if (isset(($report->data)['field_' . $item->id])) {
                        $col->addColumn($title, ($report->data)['field_' . $item->id], $colors[$item->field_category_id]);
                    } else {
                        $col->addColumn($title, 0, $colors[$item->field_category_id]);
                    }
                }
            }
        });

        return $col;
    }

    private function getLineChartModel()
    {
        $colors = FieldCategory::CATEGORY_COLORS;
        $line = new LineChartModel();
        $line->setTitle($this->form->name)->multiLine()->setColors(FieldCategory::CATEGORY_COLORS);

        $this->formFields->each(function ($item, $key) use ($line, $colors) {
            if ($item->type == 'number') {
                if ($item->class == 'computed') {
                    foreach ($this->reports as $key => $report) {
                        $title = $item->name;
                        if (isset($item->formula)) {
                            $line->addSeriesPoint($title, $report->date, FormFieldService::compute($item, $report))
                                ->addColor($colors[$item->field_category_id]);
                        } else {
                            $line->addSeriesPoint($title, $report->date, 0)->addColor($colors[$item->field_category_id]);
                        }
                    }
                } else {
                    foreach ($this->reports as $key => $report) {
                        $title = $item->name;
                        if (isset(($report->data)['field_' . $item->id])) {
                            $line->addColor($colors[$item->field_category_id])->addSeriesPoint($title, $report->date, ($report->data)['field_' . $item->id]);
                        } else {
                            $line->addColor($colors[$item->field_category_id])->addSeriesPoint($title, $report->date, ($report->data)['field_' . $item->id]);
                        }
                    }
                }
            }
        });


        return $line->addMarker('asd', 11, 'red', 'asdasd', 'blue', 'white');
    }

    public function getCheckedFieldsCollectionProperty()
    {

        return FormField::whereIn('id', $this->checkedFields)->get();
    }

    public function saveTemplate()
    {
        $res = FieldTemplate::where('name', $this->templateName)->first();
        if ($res) {
            $this->resultMessage = 'Шаблон с таким названием уже существует!';
        } elseif ($this->templateName && is_array($this->checkedFields) && count($this->checkedFields)) {
            $fieldTemplate = FieldTemplate::create([
                'name' => $this->templateName,
                'form_id' => $this->formId,
                'fields' => $this->checkedFields,
            ]);
            $this->resultMessage = 'Успешно сохранено!';
            return redirect()->route('specialist.farms.reports.index', ['farm' => $this->farm])->with(['msg' => $this->resultMessage]);

        } else {
            $this->resultMessage = 'Произошла ошибка';
        }

    }

    public function acceptFieldsCollection($id)
    {
        if ($id == 0) {
            $this->formFields = FormField::where('form_id', $this->formId)
                ->orderBy('number', 'asc')
                ->get();
        } else {
            $fieldsTemplate = FieldTemplate::find($id);
            $this->checkedFields = $fieldsTemplate->fields;
            $this->formFields = FormField::where('form_id', $this->formId)
                ->whereIn('id', $fieldsTemplate->fields)
                ->orderBy('number', 'asc')
                ->get();
        }
    }

    public function uncheckAll()
    {
        $this->checkedFields = [];
        $this->uncheckedAll = true;
    }

    public function checkAll()
    {
        $this->checkedFields = $this->formFields->pluck('id')->toArray();
        $this->uncheckedAll = false;
    }

    public function downloadExcel()
    {
        $data = [
            'reports' => $this->reports,
            'formFields' => $this->formFields->sortBy('field_category_id'),
            'form' => $this->form,
            'forms' => $this->forms,
            'formId' => $this->formId,
            'columnChartModel' => $this->columnChartModel,
            'lineChartModel' => $this->lineChartModel,
            'computedFormFields' => $this->computedFormFields,
        ];
        $name = "report_" . date("Y-m-d_H:i:s") . ".xlsx";
        return Excel::download(new ReportExport($data), "$name");
    }

    public function downloadPDF()
    {
        $pdfContent = PDF::setOptions(['isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true])
            ->loadView('livewire.specialist.farm.reports.index.partials.download-pdf-document',
                [
                    'lineChartModel' => $this->lineChartModel,
                    'svg' => $this->svg,
                ])->output();
        return response()->streamDownload(
            fn() => print($pdfContent),
            "filename.pdf"
        );
    }
}
