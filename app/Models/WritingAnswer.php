<?php

namespace App\Models;

use App\Enums\BandScore;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class WritingAnswer extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'question_id',
        'band',
        'title',
        'body',
        'order',
    ];

    protected $casts = [
        'band' => BandScore::class,
    ];

    public function question(): BelongsTo
    {
        return $this->belongsTo(WritingQuestion::class, 'question_id');
    }
}
