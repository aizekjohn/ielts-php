<?php

namespace App\Models;

use App\Enums\BandScore;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class SpeakingAnswer extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'question_id',
        'band',
        'body',
        'order',
    ];

    protected $casts = [
        'band' => BandScore::class,
    ];

    public function question(): BelongsTo
    {
        return $this->belongsTo(SpeakingQuestion::class, 'question_id');
    }
}
