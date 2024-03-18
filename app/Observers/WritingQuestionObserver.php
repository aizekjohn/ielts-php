<?php

namespace App\Observers;

use App\Models\WritingQuestion;

class WritingQuestionObserver
{
    /**
     * Handle the WritingQuestion "created" event.
     */
    public function created(WritingQuestion $writingQuestion): void
    {
        //
    }

    /**
     * Handle the WritingQuestion "updated" event.
     */
    public function updated(WritingQuestion $writingQuestion): void
    {
        //
    }

    /**
     * Handle the WritingQuestion "deleted" event.
     */
    public function deleted(WritingQuestion $writingQuestion): void
    {
        //
    }

    /**
     * Handle the WritingQuestion "restored" event.
     */
    public function restored(WritingQuestion $writingQuestion): void
    {
        //
    }

    /**
     * Handle the WritingQuestion "force deleted" event.
     */
    public function forceDeleted(WritingQuestion $writingQuestion): void
    {
        $writingQuestion->files()->forceDelete();
    }
}
