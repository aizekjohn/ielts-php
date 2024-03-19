<?php

namespace App\Observers;

use App\Events\NewsWithPush;
use App\Models\News;
use Illuminate\Support\Facades\Storage;

class NewsObserver
{
    /**
     * Handle the News "created" event.
     */
    public function created(News $news): void
    {
        if ($news->with_push) {
            event(new NewsWithPush($news));
        }
    }

    /**
     * Handle the News "updated" event.
     */
    public function updated(News $news): void
    {
        //
    }

    /**
     * Handle the News "deleted" event.
     */
    public function deleted(News $news): void
    {
        //
    }

    /**
     * Handle the News "restored" event.
     */
    public function restored(News $news): void
    {
        //
    }

    /**
     * Handle the News "force deleted" event.
     */
    public function forceDeleted(News $news): void
    {
        if ($news->image) {
            Storage::delete($news->image);
        }
    }
}
