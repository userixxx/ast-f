<?php

namespace App\Services;

use ParseError;

class ComputedFieldsService
{
    public static function execute($computedFormField, $formFields, $report)
    {
        $formula = trim($computedFormField->formula);
        $regex = "(#\d{1,20})";

        $is_match = preg_match_all("/${regex}/", $formula, $matches);

        if ($is_match && count($matches[0])) {
            $matchedFields = $matches[0];
            foreach ($matchedFields as $key => $val) {
                $preparedField = str_replace('#', '', $val);
                $formula = str_replace( $val, $report->data["field_$preparedField"] ?? 0 ,$formula);
            }
        }

        try {
            $result = eval(" return ".$formula. ';');
        } catch(ParseError $exception){
            $result = 'Требуется исправление формулы или данных';
        }

        return $result;
    }
}
