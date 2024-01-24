<?php

namespace App\Models\Api;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class FieldCategory extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    protected $table = 'field_categories';
    const CATEGORY_COLORS = [
        '#a3cfbb',
        '#a6e9d5',
        '#efadce',
        '#c5b3e6',
        '#c29ffa',
        '#9ec5fe',
        '#FFFACD',
        '#FFDAB9',
        '#FFA07A',
        '#AFEEEE',
        '#40E0D0',
        '#5F9EA0',
        '#4682B4',
        '#6B8E23',
        '#9ACD32',
        '#556B2F',
        '#8FBC8F',
        '#a3cfbb',
        '#a6e9d5',
        '#efadce',
        '#c5b3e6',
        '#c29ffa',
        '#9ec5fe',
        '#FFFACD',
        '#FFDAB9',
        '#FFA07A',
        '#AFEEEE',
        '#40E0D0',
        '#5F9EA0',
        '#4682B4',
        '#6B8E23',
        '#9ACD32',
        '#556B2F',
        '#8FBC8F',
        '#a3cfbb',
        '#a6e9d5',
        '#efadce',
        '#c5b3e6',
        '#c29ffa',
        '#9ec5fe',
        '#FFFACD',
        '#FFDAB9',
        '#FFA07A',
        '#AFEEEE',
        '#40E0D0',
        '#5F9EA0',
        '#4682B4',
        '#6B8E23',
        '#9ACD32',
        '#556B2F',
        '#8FBC8F',
        '#a3cfbb',
        '#a6e9d5',
        '#efadce',
        '#c5b3e6',
        '#c29ffa',
        '#9ec5fe',
        '#FFFACD',
        '#FFDAB9',
        '#FFA07A',
        '#AFEEEE',
        '#40E0D0',
        '#5F9EA0',
        '#4682B4',
        '#6B8E23',
        '#9ACD32',
        '#556B2F',
        '#8FBC8F',
    ];

    public function fields()
    {
        return $this->hasMany(FormField::class)->orderBy('number');
    }

    public function fieldsOrderedByNumber()
    {
        return $this->hasMany(FormField::class)->orderBy('number');
    }
}
