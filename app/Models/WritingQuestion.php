<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class WritingQuestion extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'writing_category_id',
        'body',
        'order',
    ];

    public function category()
    {
        return $this->belongsTo(WritingCategory::class, 'writing_category_id');
    }
}
