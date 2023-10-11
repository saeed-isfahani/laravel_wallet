<?php

namespace App\Jobs;

use App\Mail\RejectPayment;
use App\Models\Payment;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendRejectPaymentNotify implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct(public Payment $payment, public $text)
    {
        // 
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        Mail::to($this->payment->user->email)->send(new RejectPayment($this->payment, $this->text));
    }
}
