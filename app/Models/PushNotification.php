<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PushNotification extends Model
{
    protected $fillable = [
        'title',
        'body',
        'news_id',
    ];

    public function news(): BelongsTo
    {
        return $this->belongsTo(News::class, 'news_id', 'id');
    }
}
