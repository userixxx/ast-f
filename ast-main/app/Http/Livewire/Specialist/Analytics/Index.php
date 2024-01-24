<?php

namespace App\Http\Livewire\Specialist\Analytics;

use App\Actions\Specialist\Analytic\DownloadExcel;
use App\Models\Farm;
use App\Models\FieldCategory;
use App\Models\FieldTemplate;
use App\Models\Form;
use App\Models\FormField;
use App\Models\Organization;
use App\Models\Report;
use App\Services\Specialist\FormFieldService;
use App\Services\Specialist\PhpOfficceService;
use Asantibanez\LivewireCharts\Models\LineChartModel;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Str;
use Imagick;
use ImagickPixel;
use Livewire\Component;
use App\Services\Specialist\LineChartModelService;

class Index extends Component
{
    public $forms;
    public $formId = 0;
    public $organisations;
    public $farms = [];
    public $selectedOrganisation = '';
    public $selectedFarm = '';
    public $organisationId = 0;
    public $farmId = 0;
    public $buttonDisabled = true;
    public $reports = [];
    public Collection $formFields;
    public $selectedReports = [];
    public $selectedFormFields = [];

    public string $dateFrom = '2023-01-01';
    public string $dateTo = '';
    public $formFieldTemplates = [];
    private LineChartModel $lineChartModel;
    public $form;
    public $templateName = '';
    public $farm;

    protected $listeners = [
        'postAdded' => 'createAndDownloadPDF',
        'downloadPDF' => 'downloadPDF',
        'downloadWordWithChart' => 'downloadWord'];

    /**
     * @param $url
     * @param $farm
     * @param $legend
     * @return \Symfony\Component\HttpFoundation\StreamedResponse
     */
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
                ])->setPaper('a4', 'landscape')->output();
        return response()->streamDownload(
            fn() => print($pdfContent),
            "filename.pdf"
        );
    }


    public function __construct($id = null)
    {
        parent::__construct($id);
        $this->organisations = Organization::all();
        $this->forms = Form::all();
        $this->dateTo = now()->format('Y-m-d');
        $this->lineChartModel = new LineChartModel();
        $this->formFields = new Collection();
    }

    public function mount()
    {
        $this->formFields = new Collection();
    }

    public function render()
    {
        return view('livewire.specialist.analytics.index');
    }

    public function updatingSelectedOrganisation($value, $key)
    {
        $organisation = $this->organisations->firstWhere('name', $value);
        if ($organisation) {
            $this->organisationId = $organisation->id;
        } else {
            $this->organisationId = 0;
        }
    }

    public function updatedSelectedOrganisation($value, $key)
    {
        $organisation = $this->organisations->firstWhere('name', $value);
        if ($organisation) {
            $this->organisationId = $organisation->id;
            $this->farms = Farm::where('organization_id', $this->organisationId)->get();
        } else {
            $this->dropOrganisation();
        }
    }

    public function updatingSelectedFarm($value, $key)
    {
        $farm = $this->farms->firstWhere('name', $value);
        if ($farm) {
            $this->farmId = $farm->id;
            $this->farms = Farm::where('organization_id', $this->organisationId)->get();
            $this->farm = $farm;
        } else {
            $this->farmId = '';
        }
    }

    private function dropOrganisation()
    {
        $this->organisationId = '';
        $this->farmId = '';
        $this->selectedFarm = '';
    }

    public function updated()
    {
        if ($this->organisationId && $this->farmId && $this->formId) {
            $this->form = Form::find($this->formId);
            $this->buttonDisabled = false;
            $this->formFieldTemplates = FieldTemplate::where('form_id', $this->formId)->get();
            $this->reports = collect([]);
            $this->findReports(false);
            $this->lineChartModel = LineChartModelService::getLineChartModel($this->reports, $this->form, $this->formFields);
        } else {
            $this->buttonDisabled = true;
        }
    }

    public function findReports($flag=true)
    {

        $this->reports = Report::when($this->formId, function ($query) {
            return $query->where('form_id', $this->formId);
        })->when($this->farmId, function ($query) {
            return $query->where('farm_id', $this->farmId);
        })->when($this->dateFrom, function ($query) {
            return $query->where('date', '>=', $this->dateFrom);
        })->when($this->dateTo, function ($query) {
            return $query->where('date', '<=', $this->dateTo);
        })->orderBy('date')
            ->get();

        if($flag) {
            $this->formFields = FormField::where('form_id', $this->formId)->orderBy('number')->get();
        }
    }

    public function updatingSelectedReports($value)
    {
//        Log::info($value);
    }

    public function updatingSelectedFormFields($value)
    {
//        Log::info($value);
    }

    public function selectAllFields()
    {
        if ($this->formId) {
            $this->selectedFormFields = FormField::where('form_id', $this->formId)->pluck('id');
        }
    }

    public function useFormFieldTemplate($id)
    {
        $template = FieldTemplate::find($id);
        if ($template) {
            $this->formFields = new Collection();
            $this->formFields = FormField::whereIn('id', $template->fields)->orderBy('number')->get();
        }
    }

    public function saveFieldsTemplate()
    {
        $fieldsIds = $this->selectedFormFields;
        if (count($fieldsIds) > 0 && $this->formId && $this->templateName) {
            $template = FieldTemplate::create([
                'name' => $this->templateName,
                'fields' => $fieldsIds,
                'form_id' => $this->formId,
            ]);

            $this->templateName = '';
            $this->formFieldTemplates = FieldTemplate::where('form_id', $this->formId)->get();
            session()->flash('message', 'Шаблон удачно сохранён.');
            $this->dispatchBrowserEvent('close');

        }
    }

    public function unselectAllFields()
    {
        $this->selectedFormFields = [];
    }

    public function useAllFields()
    {
        $this->formFields = new Collection();
        $this->formFields = FormField::where('form_id', $this->formId)->orderBy('number')->get();
    }

    public function compareReports()
    {
        $this->reports = $this->reports->whereIn('id', $this->selectedReports);
        $this->formFields = $this->formFields->whereIn('id', $this->selectedFormFields);
        $this->lineChartModel = LineChartModelService::getLineChartModel($this->reports, $this->form, $this->formFields);

    }

    public function clearSelectedReports()
    {
        $this->findReports();
    }

    public function downloadExcel(DownloadExcel $downloadExcel)
    {
        $form = Form::find($this->formId);
        return $downloadExcel->execute($this->reports, $this->formFields, $form);
    }

//    public function downloadPdf()
//    {
//        $this->lineChartModel = LineChartModelService::getLineChartModel($this->reports, $this->form, $this->formFields);
//    }

    public function getLCM()
    {
        return $this->lineChartModel ?? null;
    }

    public function downloadWord($file, $legend=null)
    {
      $wordPath = PhpOfficceService::getWordDocument($this->reports, $this->form, $this->formFields, $this->farm, $file, $legend);
      return response()->download($wordPath)->deleteFileAfterSend(true);
    }

    public function downloadPDF($file, $legend)
    {
        $this->file = $file;
        $this->legend = json_decode($legend) ?? collect([]);
        $legend = str_replace('Helvetica','"DejaVu Sans"',$legend);
        $pdfContent = PDF::setOptions([
            'isHtml5ParserEnabled' => false,
            'isRemoteEnabled' => true,
            'pdf' => true
        ])
            ->loadView('livewire.specialist.analytics.partials.download-pdf-view',
                [
                    'legend' => $this->legend,
                    'file' => $this->file,
                    'farm' => $this->farm,
                    'reports' => $this->reports,
                    'formFields' => $this->formFields,
                ])->setPaper('a4', 'landscape')->output();
        return response()->streamDownload(
            fn() => print($pdfContent),
            date("Y-m-d-H-i-s")."_document.pdf"
        );
    }
}
