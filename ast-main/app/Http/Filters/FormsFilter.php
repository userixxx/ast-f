<?php

namespace App\Http\Filters;

class FormsFilter extends QueryFilter
{
    public function select(string $select)
    {
        if($select == 'withTrashed'){
            $this->builder->withTrashed();
        } elseif($select == 'trashed'){
            $this->builder->onlyTrashed();
        } elseif($select == 'withoutTrashed') {
            $this->builder->withoutTrashed();
        }else {
            $this->builder->withoutTrashed();
        }
    }
}
