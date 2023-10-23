<?php

namespace App\Listeners;

use App\Models\Transaction;
use App\Models\User;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\DB;

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
        DB::beginTransaction();
        $transactionOwner = User::find($event->payment->user_id);
        $balance = $transactionOwner->getBalance($event->payment->user_id);
        $transactionOwner->transactions()->lockForUpdate();
        $transactionData = [
            'user_id' => 1,
            'payment_id' => $event->payment->id,
            'amount' => $event->payment->amount,
            'currency' => $event->payment->currency,
            'balance' => ($balance + $event->payment->amount)
        ];
        Transaction::create($transactionData);
        DB::commit();
    }
}
