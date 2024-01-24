<?php

namespace App\Http\Filters;

class FieldTemplatesFilter extends QueryFilter
{
    public function select(string $select)
    {
        if($select == 'withTrashed'){
            $this->builder->withTrashed();
        } elseif($select == 'trashed'){
            $this->builder->onlyTrashed();
        } else {
            $this->builder->withTrashed();
        }
    }
}
