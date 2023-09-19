<?php

namespace App\Models;

use App\Enums\SpeakingPart;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SpeakingCategory extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'image',
        'part',
        'order',
    ];

    protected $casts = [
        'part' => SpeakingPart::class,
    ];
}
