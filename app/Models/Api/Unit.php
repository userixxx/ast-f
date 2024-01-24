<?php

namespace App\Models\Api;

use App\Models\Traits\UsesUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Unit extends Model
{
    use HasFactory, UsesUuid;

    protected $fillable = ['id','name','description'];

    public static function boot()
    {
        parent::boot(); // TODO: Change the autogenerated stub

        static::creating(fn(Model $model) => $model->id = Str::uuid());
    }
}
