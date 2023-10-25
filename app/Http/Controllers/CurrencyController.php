<?php

namespace App\Http\Controllers;

use App\Traits\ApiResponse;
use App\Http\Requests\StoreCurrencyRequest;
use App\Http\Requests\UpdateCurrencyRequest;
use App\Http\Resources\CurrencyCollection;
use App\Http\Resources\CurrencyResource;
use App\Models\Currency;
use Symfony\Component\HttpFoundation\Exception\BadRequestException;

class CurrencyController extends Controller
{
    use ApiResponse;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $currencies = Currency::paginate();
        return $this->successResponse(new CurrencyCollection($currencies), 200);
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
    public function store(StoreCurrencyRequest $request)
    {
        if (Currency::firstWhere('key', $request->key)) {
            throw new BadRequestException(__('currency.errors.duplicate_key'));
        }

        if ($currency = Currency::create($request->all())) {
            return $this->successResponse(new CurrencyResource($currency), __('currency.messages.create_successfull'), 201);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Currency $currency)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Currency $currency)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatecurrencyRequest $request, Currency $currency)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Currency $currency)
    {
        //
    }
}
