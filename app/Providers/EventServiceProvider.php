<?php

namespace App\Providers;

use App\Models\File;
use App\Models\SpeakingCategory;
use App\Models\User;
use App\Models\WritingCategory;
use App\Models\WritingQuestion;
use App\Observers\FileObserver;
use App\Observers\SpeakingCategoryObserver;
use App\Observers\UserObserver;
use App\Observers\WritingCategoryObserver;
use App\Observers\WritingQuestionObserver;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event to listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
    ];

    /**
     * Register any events for your application.
     */
    public function boot(): void
    {
        SpeakingCategory::observe(SpeakingCategoryObserver::class);
        WritingCategory::observe(WritingCategoryObserver::class);
        WritingQuestion::observe(WritingQuestionObserver::class);
        File::observe(FileObserver::class);
        User::observe(UserObserver::class);
    }

    /**
     * Determine if events and listeners should be automatically discovered.
     */
    public function shouldDiscoverEvents(): bool
    {
        return false;
    }
}
