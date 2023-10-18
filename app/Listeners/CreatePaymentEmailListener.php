<?php

namespace App\Listeners;

use App\Jobs\SendCreatePaymentNotify;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class CreatePaymentEmailListener implements ShouldQueue
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(object $event): void
    {
        SendCreatePaymentNotify::dispatch($event->payment);
    }
}
