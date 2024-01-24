<?php

namespace App\Models\Api;

use Illuminate\Database\Eloquent\Model;

class Region extends Model
{
    protected $guarded = [];

    public function districts()
    {
        return $this->hasMany(District::class);
    }
}
