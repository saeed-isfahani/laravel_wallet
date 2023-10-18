<?php

namespace App\Listeners;

use App\Models\Transaction;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class ApprovePaymentTransactionListener implements ShouldQueue
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
        $balance = Transaction::where('user_id', $event->payment->user_id)->sum('amount');
        $transactionData = [
            'user_id' => 1,
            'payment_id' => $event->payment->id,
            'amount' => $event->payment->amount,
            'currency' => $event->payment->currency,
            'balance' => ($balance + $event->payment->amount)
        ];
        Transaction::create($transactionData);
    }
}
