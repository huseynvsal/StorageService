<?php

namespace App\Providers;

use App\Domains\Document\Events\DocumentCreating;
use App\Domains\Document\Listeners\DocumentCreatingListener;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class
        ],
        DocumentCreating::class => [
            DocumentCreatingListener::class
        ],
    ];

    public function boot()
    {
        //
    }

    public function shouldDiscoverEvents(): bool
    {
        return false;
    }
}
