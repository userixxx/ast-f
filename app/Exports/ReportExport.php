<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class ReportExport implements FromView
{
    public function __construct($data)
    {
        $this->reports = $data['reports'];
        $this->formFields = $data['formFields'];
        $this->form = $data['form'];
        $this->forms = $data['forms'];
        $this->formId = $data['formId'];
        $this->columnChartModel = $data['columnChartModel'];
        $this->lineChartModel = $data['lineChartModel'];
        $this->computedFormFields = $data['computedFormFields'];

    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function view(): View
    {

        return view('livewire.specialist.farm.reports.index.partials.excel-table', [
            'reports' => $this->reports,
            'formFields' => $this->formFields->sortBy('field_category_id'),
            'form' => $this->form,
            'forms' => $this->forms,
            'formId' => $this->formId,
            'columnChartModel' => $this->columnChartModel,
            'lineChartModel' => $this->lineChartModel,
            'computedFormFields' => $this->computedFormFields,
        ]);
    }
}
