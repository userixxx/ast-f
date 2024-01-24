<?php

namespace App\Helpers;

use Illuminate\Support\Collection;

if(!function_exists('collectR')){
    function collectR(array $array) : Collection
    {
        foreach ($array as $key => $value) {
            if (is_array($value)) {
                $value = collectR($value);
                $array[$key] = $value;
            }
        }

        return collect($array);
    }
};
