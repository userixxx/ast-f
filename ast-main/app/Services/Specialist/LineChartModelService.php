<?php

namespace App\Services\Specialist;

use App\Models\FieldCategory;
use Asantibanez\LivewireCharts\Models\LineChartModel;

class LineChartModelService
{
    public static function getLineChartModel($reports, $form, $formFields, )
    {
        $colors = FieldCategory::CATEGORY_COLORS;
        $line = new LineChartModel();
        $line->setTitle($form->name)->multiLine()->setColors(FieldCategory::CATEGORY_COLORS);

        foreach($reports as $report) {
            foreach($formFields as $field) {
                if ($field->type == 'number') {
                            $title = $field->name;
                    if ($field->class == 'computed') {
                            if (isset($field->formula)) {
                                $line->addSeriesPoint($title, $report->date, FormFieldService::compute($field, $report))
                                    ->addColor($colors[$field->field_category_id]);
                            } else {
                                $line->addSeriesPoint($title, $report->date, 0)->addColor($colors[$field->field_category_id]);
                            }
                    } else {
                            if (isset(($report->data)['field_' . $field->id])) {
                                $line->addColor($colors[$field->field_category_id])->addSeriesPoint($title, $report->date, ($report->data)['field_' . $field->id]);
                            } else {
                                $line->addColor($colors[$field->field_category_id])->addSeriesPoint($title, $report->date, 0);
                            }
                    }
                }

            }

        }


        return $line;
    }
}
