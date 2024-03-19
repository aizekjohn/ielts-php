<?php

namespace App\Events;

use App\Models\News;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class NewsWithPush
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    private News $news;

    /**
     * Create a new event instance.
     */
    public function __construct(News $news)
    {
        $this->news = $news;
    }
}
