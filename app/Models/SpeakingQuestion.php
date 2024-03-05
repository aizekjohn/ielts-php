<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SpeakingQuestion extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'speaking_category_id',
        'body',
        'order',
    ];

    public function category()
    {
        return $this->belongsTo(SpeakingCategory::class, 'speaking_category_id');
    }
}
