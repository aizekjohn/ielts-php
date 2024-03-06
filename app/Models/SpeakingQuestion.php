<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class SpeakingQuestion extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'speaking_category_id',
        'body',
        'order',
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(SpeakingCategory::class, 'speaking_category_id');
    }

    public function answers(): HasMany
    {
        return $this->hasMany(SpeakingAnswer::class, 'question_id');
    }
}
