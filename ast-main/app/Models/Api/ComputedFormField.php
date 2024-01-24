<?php

namespace App\Models\Api;


use App\Http\Filters\QueryFilter;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ComputedFormField extends Model
{
    use HasFactory, SoftDeletes;
    protected $guarded = ['id'];

    protected $casts = [
        'select_fields' => 'array',
    ];

    const UNITS = [
        'кг',
        'т',
        'ц',
        'шт',
        'л',
        'гол',
        'м',
        '%',
        'руб.',
        'мин.',
        '-',
    ];

    public function form()
    {
        return $this->belongsTo(Form::class)->withTrashed();
    }

    public function setSelectFieldsAttribute($value):void
    {
        if($value){
            $itemsArray = explode(',',$value);
            $trimmedArray = array_map('trim', $itemsArray);
            $jsonItems = json_encode($trimmedArray);
            $this->attributes['select_fields'] = $jsonItems;
        }
    }

    public function category()
    {
        return $this->belongsTo(FieldCategory::class, 'field_category_id', 'id');
    }

    public function getTranslatedOperatorAAttribute():string
    {
        return $this->getTranslatedOperatorName($this->attributes['operator_a']);
    }
    public function getTranslatedOperatorBAttribute():string
    {
        return $this->getTranslatedOperatorName($this->attributes['operator_b']);
    }
    public function getTranslatedOperatorCAttribute():string
    {
        return $this->getTranslatedOperatorName($this->attributes['operator_c']);
    }

    protected function getTranslatedOperatorName($name):string
    {
        switch($name) {
            case 'sum': return 'сумма';
            case 'avg': return 'среднее';
            case 'join': return 'объединение';
            case 'count': return 'количество';
        }
    }

    public function getTypeNameAttribute($name) : string
    {
        $name = $this->attributes['type'];
        switch($name) {
            case 'select': return 'выпадающий список';
            case 'text': return 'текст';
            case 'number': return 'число';
            case 'checkbox': return 'чекбокс';
            case 'radio': return 'радиокнопки';
        }
    }

    public function getJoinedSelectFieldsAttribute(): string
    {
        return collect(json_decode($this->attributes['select_fields']))->join(',');
    }


    public function scopeFilter(Builder $builder, QueryFilter $filter)
    {
        $filter->apply($builder);
    }
}
