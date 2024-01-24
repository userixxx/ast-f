<?php

namespace App\Models;

class District extends \Illuminate\Database\Eloquent\Model
{
    protected $guarded = [];

    public function region()
    {
        return $this->belongsTo(Region::class);
    }
}
