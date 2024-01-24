<?php

namespace App\Services\Specialist;

class ReportService
{
    public function compareSelectedReports($selectedReports, $formFields)
    {
        $result = $formFields?->map(function($item){
            return $item;
        });

        return $result;
    }
}
