<?php

namespace App\Listeners;

use App\Events\RejectPayment;
use App\Mail\RejectPayment as MailRejectPayment;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class RejectPaymentEmail implements ShouldQueue
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
    public function handle(RejectPayment $event): void
    {
        Mail::to($event->payment->user->email)->send(new MailRejectPayment($event->payment));
    }
}
