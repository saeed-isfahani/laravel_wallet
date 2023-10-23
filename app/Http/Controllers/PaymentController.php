<?php

namespace App\Http\Controllers;

use App\Events\ApprovePaymentEvent;
use App\Events\CreatePaymentEvent;
use App\Events\RejectPaymentEvent;
use App\Http\Requests\StorepaymentRequest;
use App\Http\Resources\PaymentCollection;
use App\Http\Resources\PaymentResource;
use App\Models\Payment;
use App\Traits\ApiResponse;
use Carbon\Carbon;
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
        return $this->successResponse(new PaymentCollection($payments), 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorepaymentRequest $request)
    {
        if ($payment = Payment::create(array_merge($request->all(), ['user_id' => 1]))) {
            CreatePaymentEvent::dispatch($payment);
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
        throw new BadRequestException(__('payment.errors.not_found'), 400);
    }

    /**
     * approve the specified Payment from storage.
     */
    public function approve(String $uniqueId)
    {
        $payment = Payment::firstWhere('unique_id', $uniqueId);

        if (!$payment) {
            throw new BadRequestException(__('payment.errors.not_found'), 400);
        }

        if ($payment->status->value != 'pending') {
            throw new BadRequestException(__('payment.errors.not_pending'), 400);
        }
        $payment->status = 'approved';
        $payment->status_update_at = Carbon::now();
        $payment->status_update_by = 1;
        $payment->save();
        ApprovePaymentEvent::dispatch($payment);
        return $this->successResponse(new PaymentResource($payment), __('payment.messages.approve_successfull'), 200);
    }

    /**
     * reject the specified Payment from storage.
     */
    public function reject(String $uniqueId)
    {
        $payment = Payment::firstWhere('unique_id', $uniqueId);
        if (!$payment) {
            throw new BadRequestException(__('payment.errors.not_found'), 400);
        }

        if ($payment->status->value != 'pending') {
            throw new BadRequestException(__('payment.errors.not_pending'), 400);
        }

        $payment->status = 'rejected';
        $payment->status_update_at = Carbon::now();
        $payment->status_update_by = 1;
        $payment->save();
        RejectPaymentEvent::dispatch($payment);
        return $this->successResponse(new PaymentResource($payment), __('payment.messages.reject_successfull'), 200);
    }
}
