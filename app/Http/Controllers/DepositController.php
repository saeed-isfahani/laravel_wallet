<?php

namespace App\Http\Controllers;

use App\Http\Requests\DepositRequest;
use App\Models\Transaction;
use App\Models\User;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Exception\BadRequestException;

class DepositController extends Controller
{
    use ApiResponse;
    public function transfer(DepositRequest $request)
    {
        DB::beginTransaction();

        if (!$fromUser = User::where('id', $request->from_user)->first()) {
            DB::rollBack();
            throw new BadRequestException(__('deposit.errors.from_user_not_exist'), 400);
        }

        if (!$toUser = User::where('id', $request->to_user)->first()) {
            DB::rollBack();
            throw new BadRequestException(__('deposit.errors.to_user_not_exist'), 400);
        }

        $fromUserBalance = $fromUser->getBalance($request->currency_key);
        if ($fromUserBalance < $request->amount) {
            DB::rollBack();
            throw new BadRequestException(__('deposit.errors.from_user_balance_lower_than_transfer_amount'), 400);
        }
        
        $fromUser->transactions()->lockForUpdate();
        $toUser->transactions()->lockForUpdate();

        $fromUserTransactionData = [
            'user_id' => $request->from_user,
            'amount' => -$request->amount,
            'currency_key' => $request->currency_key,
            'balance' => ($fromUserBalance - $request->amount),
        ];
        Transaction::create($fromUserTransactionData);

        $toUserBalance = $toUser->getBalance($request->currency_key);
        $toTransactionData = [
            'user_id' => $request->to_user,
            'amount' => $request->amount,
            'currency_key' => $request->currency_key,
            'balance' => ($toUserBalance + $request->amount),
        ];
        Transaction::create($toTransactionData);

        $fromUser->updateBalance();
        $toUser->updateBalance();

        DB::commit();
        
        return $this->successResponse([], __('deposit.messages.deposit_transfer_successfull'), 201);
    }
}
