<?php

namespace App\Listeners;

use App\Jobs\SendApprovePaymentNotify;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class ApprovePaymentEmailListener 
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
        SendApprovePaymentNotify::dispatch($event->payment);
    }
}
