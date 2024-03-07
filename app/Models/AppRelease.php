<?php

namespace App\Models;

use App\Enums\DevicePlatform;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AppRelease extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'platform',
        'version',
        'release_date',
        'update_required',
    ];

    protected $casts = [
        'platform' => DevicePlatform::class,
        'release_date' => 'date',
        'update_required' => 'bool',
    ];
}
