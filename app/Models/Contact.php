<?php

namespace App\Models;

use App\Models\Interfaces\Contactable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Contact extends Model
{
    use HasFactory, SoftDeletes;
    protected $guarded = ['id'];

    public function contactable()
    {
        return $this->morphTo();
    }

    public function organization()
    {
        return $this->belongsTo(Organization::class, 'contactable_id', 'id', 'contactable_type');
    }
}
