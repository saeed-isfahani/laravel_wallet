<?php

namespace App\Providers;

use App\Events\RejectPayment;
use App\Events\ApprovePaymentEvent;
use App\Listeners\ApprovePaymentEmailListener;
use App\Listeners\ApprovePaymentTransactionListener;
use App\Listeners\RejectPaymentEmail;
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
        RejectPayment::class => [
            RejectPaymentEmail::class,
        ],
        ApprovePaymentEvent::class => [
            ApprovePaymentEmailListener::class,
            ApprovePaymentTransactionListener::class,
        ],
    ];

    /**
     * Register any events for your application.
     */
    public function boot(): void
    {
        //
    }

    /**
     * Determine if events and listeners should be automatically discovered.
     */
    public function shouldDiscoverEvents(): bool
    {
        return false;
    }
}
