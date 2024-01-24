<?php

namespace App\Models\Api;

use App\Http\Filters\QueryFilter;
use App\Models\Traits\HasContacts;
use App\Models\Traits\UsesUuid;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Farm extends Model
{
    protected $table = 'farms';
    use HasFactory, HasContacts, SoftDeletes, UsesUuid;
    protected $guarded =['id'];

    public function region()
    {
        return $this->belongsTo(Region::class);
    }

    public function district()
    {
        return $this->belongsTo(District::class);
    }

    public function organization()
    {
        return $this->belongsTo(Organization::class)->withTrashed();
    }

    public function reports()
    {
        return $this->hasMany(Report::class, 'farm_id', 'id');
    }

    public function scopeFilter(Builder $builder, QueryFilter $filter)
    {
        $filter->apply($builder);
    }

    public static function boot(): void
    {
        parent::boot();

        self::deleted(function (Farm $farm) {
            foreach ($farm->reports as $report) {
                $report->delete();
            };
        });

        self::restored(function (Farm $farm) {
            $farm->organization()->restore();
        });

//        self::forceDeleted(function(Farm $farm){
//            foreach ($farm->reports()->withTrashed()->get() as $report) {
//                $report->forceDelete();
//            };
//        });
    }
}
