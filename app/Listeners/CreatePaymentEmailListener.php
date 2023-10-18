<?php

namespace App\Listeners;

use App\Mail\CreatePaymentMail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

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
    public function handle(CreatePaymentMail $event): void
    {
        Mail::to($event->payment->user->email)->send(new CreatePaymentMail($event->payment));
    }
}
