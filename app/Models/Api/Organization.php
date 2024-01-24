<?php

namespace App\Models\Api;

use App\Http\Filters\QueryFilter;
use App\Models\Interfaces\Contactable;
use App\Models\Traits\HasContacts;
use App\Models\Traits\UsesUuid;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class Organization extends Model implements Contactable
{
    use HasFactory, SoftDeletes, HasContacts, UsesUuid;

    protected $guarded = ['id'];

    protected $casts = [
        'id' => 'string',
        'data' => 'array'
    ];

    public function getDataAttribute($value)
    {
        return json_decode($value, true);
    }

    public function setDataAttribute($value)
    {
        $this->attributes['data'] = json_encode($value);
    }

    public function region()
    {
        return $this->belongsTo(Region::class);
    }

    public function district()
    {
        return $this->belongsTo(District::class);
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'creator_id', 'id');
    }

    public function farms()
    {
        return $this->hasMany(Farm::class);
    }

    public function reports()
    {
        return $this->hasMany(Report::class);
    }

    public function scopeFilter(Builder $builder, QueryFilter $filter)
    {
        $filter->apply($builder);
    }

    public static function boot()
    {
        parent::boot();

        self::deleted(function (Organization $organization) {
            foreach ($organization->farms as $farm) {
                $farm->delete();
            }
        });

        self::restored(function (Organization $organization) {
            foreach ($organization->farms()->withTrashed()->get() as $farm) {
                $farm->restore();
            }
        });
    }
}
