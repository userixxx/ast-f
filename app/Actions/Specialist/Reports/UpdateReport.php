<?php

namespace App\Actions\Specialist\Reports;

class UpdateReport
{
    public function execute($validatedRequest, $report)
    {
        return $report->update($validatedRequest);
    }
}
