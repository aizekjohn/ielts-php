<?php

namespace App\Models;

use App\Enums\SpeakingPart;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class SpeakingCategory extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'image',
        'part',
        'order',
    ];

    protected $casts = [
        'part' => SpeakingPart::class,
    ];

    public function questions(): HasMany
    {
        return $this->hasMany(SpeakingQuestion::class, 'speaking_category_id');
    }
}
