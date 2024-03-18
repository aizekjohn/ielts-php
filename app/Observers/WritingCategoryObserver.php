<?php

namespace App\Observers;

use App\Models\WritingCategory;
use Illuminate\Support\Facades\Storage;

class WritingCategoryObserver
{
    /**
     * Handle the WritingCategory "created" event.
     */
    public function created(WritingCategory $writingCategory): void
    {
        //
    }

    /**
     * Handle the WritingCategory "updated" event.
     */
    public function updated(WritingCategory $writingCategory): void
    {
        //
    }

    /**
     * Handle the WritingCategory "deleted" event.
     */
    public function deleted(WritingCategory $writingCategory): void
    {
        //
    }

    /**
     * Handle the WritingCategory "restored" event.
     */
    public function restored(WritingCategory $writingCategory): void
    {
        //
    }

    /**
     * Handle the WritingCategory "force deleted" event.
     */
    public function forceDeleted(WritingCategory $writingCategory): void
    {
        Storage::delete($writingCategory->image);
    }
}
