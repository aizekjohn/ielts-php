<?php

namespace App\Observers;

use App\Models\SpeakingCategory;
use Illuminate\Support\Facades\Storage;

class SpeakingCategoryObserver
{
    /**
     * Handle the SpeakingCategory "created" event.
     */
    public function created(SpeakingCategory $speakingCategory): void
    {
        //
    }

    /**
     * Handle the SpeakingCategory "updated" event.
     */
    public function updated(SpeakingCategory $speakingCategory): void
    {
        //
    }

    /**
     * Handle the SpeakingCategory "deleted" event.
     */
    public function deleted(SpeakingCategory $speakingCategory): void
    {
        //
    }

    /**
     * Handle the SpeakingCategory "restored" event.
     */
    public function restored(SpeakingCategory $speakingCategory): void
    {
        //
    }

    /**
     * Handle the SpeakingCategory "force deleted" event.
     */
    public function forceDeleted(SpeakingCategory $speakingCategory): void
    {
        Storage::delete($speakingCategory->image);
    }
}
