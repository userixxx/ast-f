<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class ReportsExport implements FromView
{
    private mixed $reports;
    private mixed $formFields;
    private mixed $form;

    public function __construct($reports, $formFields, $form)
    {
        $this->reports = $reports;
        $this->formFields = $formFields;
        $this->form = $form;
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function view(): View
    {

        return view('excel.excel-horizontal', [
            'reports' => $this->reports,
            'formFields' => $this->formFields->sortBy('field_category_id'),
        ]);
    }
}
