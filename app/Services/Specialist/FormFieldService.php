<?php

namespace App\Services\Specialist;

use DivisionByZeroError;
use Illuminate\Support\Facades\Log;
use mysql_xdevapi\Exception;
use ParseError;

class FormFieldService
{
    public static function compute($formField,$report)
    {
        $formula = trim($formField->formula);
        $regex = "(#\d{1,20})";

        $is_match = preg_match_all("/${regex}/", $formula, $matches);

        try {
            if ($is_match && count($matches[0])) {
                $matchedFields = $matches[0];
                foreach ($matchedFields as $key => $val) {
                    $preparedField = str_replace('#', '', $val);
                    $formula = str_replace( $val, $report->data["field_$preparedField"] ?? 0 ,$formula);
                }
            }
        } catch (\Exception $exception) {
            Log::alert($exception);
            return 'ex';
        }

        try {
            $result = eval(" return ".$formula. ';');
        } catch(DivisionByZeroError $exception){
            $result = '/0';
        }catch(ParseError $exception){
            $result = 'Требуется исправление формулы или данных';
        }

        if(is_numeric($result)){
            $result = round($result, 2);
        }

        return $result;
    }
}
