<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WritingQuestion extends Model
{
    use HasFactory;

    protected $fillable = [
        'writing_category_id',
        'body',
    ];

    public function category()
    {
        return $this->belongsTo(WritingCategory::class, 'writing_category_id');
    }
}
