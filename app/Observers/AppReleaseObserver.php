<?php

namespace App\Observers;

use App\Models\AppRelease;
use Illuminate\Support\Facades\Cache;

class AppReleaseObserver
{
    /**
     * Handle the AppRelease "created" event.
     */
    public function created(AppRelease $appRelease): void
    {
        $this->clearCacheByPlatform($appRelease->platform);
    }

    /**
     * Handle the AppRelease "updated" event.
     */
    public function updated(AppRelease $appRelease): void
    {
        Cache::delete('app_release_ios');
        Cache::delete('app_release_android');
    }

    /**
     * Handle the AppRelease "deleted" event.
     */
    public function deleted(AppRelease $appRelease): void
    {
        $this->clearCacheByPlatform($appRelease->platform);
    }

    /**
     * Handle the AppRelease "restored" event.
     */
    public function restored(AppRelease $appRelease): void
    {
        $this->clearCacheByPlatform($appRelease->platform);
    }

    /**
     * Handle the AppRelease "force deleted" event.
     */
    public function forceDeleted(AppRelease $appRelease): void
    {
        $this->clearCacheByPlatform($appRelease->platform);
    }

    private function clearCacheByPlatform(string $platform): void
    {
        Cache::delete('app_release_' . $platform);
    }
}
