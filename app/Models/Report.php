<?php

namespace App\Models;

use App\Http\Filters\QueryFilter;
use App\Models\Traits\UsesUuid;
use App\Observers\ReportObserver;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Report extends Model implements HasMedia
{
    use HasFactory, SoftDeletes, InteractsWithMedia, UsesUuid;

    protected $guarded = ['id'];

    protected $casts =[
        'data' => 'array',
    ];

    public function farm()
    {
        return $this->belongsTo(Farm::class, 'farm_id', 'id')->withTrashed();
    }

    public function form()
    {
        return $this->belongsTo(Form::class)->withTrashed();
    }

    public function organization()
    {
        return $this->belongsTo(Organization::class)->withTrashed();
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'user_id', 'id')->withTrashed();
    }

    public function scopeFilter(Builder $builder, QueryFilter $filter)
    {
        $filter->apply($builder);
    }

    public static function boot(): void
    {
        parent::boot();

        self::restored(function (Report $report) {
            $report->farm()->restore();
            $report->organization()->restore();
        });

    }


}
