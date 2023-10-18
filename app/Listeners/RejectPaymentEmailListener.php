<?php

namespace App\Listeners;

use App\Events\Event;
use App\Jobs\SendRejectPaymentNotify;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class RejectPaymentEmailListener implements ShouldQueue
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
        SendRejectPaymentNotify::dispatch($event->payment);
    }
}
