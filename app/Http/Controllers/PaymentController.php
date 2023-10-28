<?php

namespace App\Http\Controllers;

use App\Enums\Payments\PaymentStatus;
use App\Events\PaymentApproved;
use App\Events\PaymentCreated;
use App\Events\RejectPaymentEvent;
use App\Http\Requests\StorePaymentRequest;
use App\Http\Resources\PaymentCollection;
use App\Http\Resources\PaymentResource;
use App\Models\Payment;
use App\Models\Transaction;
use App\Models\User;
use App\Traits\ApiResponse;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Exception\BadRequestException;

class PaymentController extends Controller
{
    use ApiResponse;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $payments = Payment::paginate();
        // TODO resolve pagination problem in collection and response
        return $this->successResponse(new PaymentCollection($payments), 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePaymentRequest $request)
    {
        $paymentLimitationTime = 5;
        $paymentInLimitationTime = Payment::where('user_id', $request->user_id)
            ->where('currency_key', $request->currency_key)
            ->where('created_at', '>', Carbon::now()->subMinutes($paymentLimitationTime)->toDateTimeString())
            ->exists();
        if ($paymentInLimitationTime) {
            throw new BadRequestException(__('payment.errors.payment_creation_time_limit', ['currency' => $request->currency_key, 'minute' => $paymentLimitationTime]));
        }
        // TODO don't need to if because of using route model binding
        if ($payment = Payment::create($request->all())) {
            PaymentCreated::dispatch($payment);
            // TODO make it as a service fecade
            return $this->successResponse(new PaymentResource($payment), __('payment.messages.create_successfull'), 201);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(String $uniqueId)
    {
        $payment = Payment::firstWhere('unique_id', $uniqueId);

        if ($payment) {
            return $this->successResponse(new PaymentResource($payment), __('payment.messages.found_successfull'), 200);
        }

        throw new BadRequestException(__('payment.errors.not_found'));
    }

    /**
     * approve the specified Payment from storage.
     */
    public function approve(String $uniqueId)
    {
        $payment = Payment::firstWhere('unique_id', $uniqueId);

        if (!$payment) {
            throw new BadRequestException(__('payment.errors.not_found'));
        }

        if ($payment->status != PaymentStatus::PENDING) {
            throw new BadRequestException(__('payment.errors.not_pending'));
        }

        DB::beginTransaction();

        $payment->update([
            'status' => PaymentStatus::APPROVED->value,
            'status_update_at' => Carbon::now(),
            'status_update_by' => auth()->user()->id
        ]);

        $transactionOwner = User::find($payment->user_id);
        $balance = $transactionOwner->getBalance($payment->user_id);
        $transactionOwner->transactions()->lockForUpdate();
        $transactionData = [
            'user_id' => 1,
            'payment_id' => $payment->id,
            'amount' => $payment->amount,
            'currency_key' => $payment->currency_key,
            'balance' => ($balance + $payment->amount)
        ];
        Transaction::create($transactionData);

        DB::commit();

        PaymentApproved::dispatch($payment);

        return $this->successResponse(new PaymentResource($payment), __('payment.messages.approve_successfull'), 200);
    }

    /**
     * reject the specified Payment from storage.
     */
    public function reject(String $uniqueId)
    {
        $payment = Payment::firstWhere('unique_id', $uniqueId);
        if (!$payment) {
            throw new BadRequestException(__('payment.errors.not_found'));
        }

        if ($payment->status != PaymentStatus::PENDING) {
            throw new BadRequestException(__('payment.errors.not_pending'));
        }

        $payment->update([
            'status' => PaymentStatus::REJECTED->value,
            'status_update_at' => Carbon::now(),
            'status_update_by' => auth()->user()->id
        ]);
        RejectPaymentEvent::dispatch($payment);
        return $this->successResponse(new PaymentResource($payment), __('payment.messages.reject_successfull'), 200);
    }
}
