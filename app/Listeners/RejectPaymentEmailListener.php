<?php

namespace App\Listeners;

use App\Events\Event;
use App\Mail\RejectPaymentMail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

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
    public function handle(RejectPaymentMail $event): void
    {
        Mail::to($event->payment->user->email)->send(new RejectPaymentMail($event->payment));
    }
}
