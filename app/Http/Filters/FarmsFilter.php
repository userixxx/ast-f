<?php

namespace App\Http\Filters;

class FarmsFilter extends QueryFilter
{
    public function select(string $select)
    {
        if($select == 'withTrashed'){
            $this->builder->withTrashed();
        } elseif($select == 'trashed'){
            $this->builder->onlyTrashed();
        } else {
            $this->builder;
        }
    }

    public function name(string $name)
    {
        $this->builder->where('name', 'like', '%'.$name.'%');
    }
}
