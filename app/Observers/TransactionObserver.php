<?php

namespace App\Observers;

use App\Models\Transaction;
use App\Models\User;
use Symfony\Component\HttpFoundation\Exception\BadRequestException;

class TransactionObserver
{
    /**
     * Handle the Transaction "created" event.
     */
    public function created(Transaction $transaction): void
    {
        $transactionOwner = User::find($transaction->user_id);
        if(!$transactionOwner){
            throw new BadRequestException(__('transaction.errors.transaction_creating_error_user_not_found'));
        }

        $transactionOwner->updateBalance();
    }

    /**
     * Handle the Transaction "updated" event.
     */
    public function updated(Transaction $transaction): void
    {
        //
    }

    /**
     * Handle the Transaction "deleted" event.
     */
    public function deleted(Transaction $transaction): void
    {
        //
    }

    /**
     * Handle the Transaction "restored" event.
     */
    public function restored(Transaction $transaction): void
    {
        //
    }

    /**
     * Handle the Transaction "force deleted" event.
     */
    public function forceDeleted(Transaction $transaction): void
    {
        //
    }
}
