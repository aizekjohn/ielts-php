<?php

namespace App\Models;

use App\Enums\WritingPart;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class WritingCategory extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'image',
        'part',
        'order',
    ];

    protected $casts = [
        'part' => WritingPart::class,
    ];

    public function questions(): HasMany
    {
        return $this->hasMany(WritingQuestion::class, 'writing_category_id');
    }
}
