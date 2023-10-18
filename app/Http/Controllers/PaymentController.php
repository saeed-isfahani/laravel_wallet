<?php

namespace App\Http\Controllers;

use App\Events\ApprovePaymentEvent;
use App\Events\CreatePaymentEvent;
use App\Events\RejectPaymentEvent;
use App\Http\Requests\StorepaymentRequest;
use App\Http\Requests\UpdatepaymentRequest;
use App\Http\Resources\PaymentResource;
use App\Models\Payment;
use App\Models\Transaction;
use App\Traits\ApiResponse;
use App\Jobs\SendRejectPaymentNotify;

class PaymentController extends Controller
{
    use ApiResponse;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorepaymentRequest $request)
    {
        if ($payment = Payment::create(array_merge($request->all(), ['user_id' => 1]))) {
            // $text = 'test';
            CreatePaymentEvent::dispatch($payment);
            // RejectPaymentEvent::dispatch($payment);
            // SendRejectPaymentNotify::dispatch($payment, $text);
            return $this->successResponse(new PaymentResource($payment), __('payment.messages.create_successfull'), 201);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Payment $payment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Payment $payment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatepaymentRequest $request, Payment $payment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Payment $payment)
    {
        //
    }
}
