<?php

namespace App\Actions\Specialist\Analytic;

use App\Exports\ReportExport;
use App\Exports\ReportsExport;
use Maatwebsite\Excel\Facades\Excel;

class DownloadExcel
{
    public function execute($reports, $formFields, $form)
    {
        $name = "report_" . date("Y-m-d_H:i:s") . ".xlsx";
        return Excel::download(new ReportsExport($reports, $formFields, $form), "$name");
    }
}
