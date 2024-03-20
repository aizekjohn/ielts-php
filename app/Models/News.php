<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class News extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'title',
        'content',
        'image',
        'views',
        'with_push',
    ];

    protected $casts = [
        'with_push' => 'bool',
    ];

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'news_user', 'news_id', 'user_id')->withTimestamps();
    }

    public function safeIncreaseViews(): void
    {
        $this->increment('views');
    }
}
