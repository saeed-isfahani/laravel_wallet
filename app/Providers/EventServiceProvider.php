<?php

namespace App\Providers;

use App\Events\PaymentCreated;
use App\Events\PaymentApproved;
use App\Events\RejectPaymentEvent;
use App\Listeners\CreatePaymentEmailListener;
use App\Listeners\ApprovePaymentEmailListener;
use App\Listeners\ApprovePaymentTransactionListener;
use App\Listeners\RejectPaymentEmailListener;
use App\Listeners\UpdateUserBalanceListener;
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
        PaymentCreated::class => [
            CreatePaymentEmailListener::class,
        ],
        PaymentApproved::class => [
            ApprovePaymentEmailListener::class,
            ApprovePaymentTransactionListener::class,
            UpdateUserBalanceListener::class,
        ],
        RejectPaymentEvent::class => [
            RejectPaymentEmailListener::class,
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
