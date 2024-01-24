<?php

namespace App\Models\Api;

use App\Http\Filters\QueryFilter;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Form extends Model
{
    use HasFactory, SoftDeletes;
    protected $guarded = ['id'];

    public function fields()
    {
        return $this->hasMany(FormField::class);
    }
    public function computedFields()
    {
        return $this->hasMany(ComputedFormField::class);
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'creator_id', 'id');
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'users', 'form_id', 'user_id');
    }

    public function category()
    {
        return $this->belongsTo(FormCategory::class, 'category_id', 'id');
    }

    public function reports()
    {
        return $this->hasMany(Report::class);
    }
    public function fieldTemplates()
    {
        return $this->hasMany(FieldTemplate::class, 'form_id', 'id');
    }

    public function scopeFilter(Builder $builder, QueryFilter $filter)
    {
        $filter->apply($builder);
    }

    public function sortedFieldsByNumber()
    {
        return  $this->hasMany(FormField::class)->orderByRaw('-number desc');
    }

    public static function boot(): void
    {
        parent::boot();

        self::deleted(function (Form $form) {
            foreach ($form->fieldTemplates as $fieldTemplate) {
                $fieldTemplate->delete();
            };
        });
    }
}
