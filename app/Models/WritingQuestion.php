<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class WritingQuestion extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'writing_category_id',
        'body',
        'order',
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(WritingCategory::class, 'writing_category_id');
    }

    public function files(): MorphMany
    {
        return $this->morphMany(File::class, 'fileable');
    }

    public function answers(): HasMany
    {
        return $this->hasMany(WritingAnswer::class, 'question_id');
    }
}
