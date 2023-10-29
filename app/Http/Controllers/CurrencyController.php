<?php

namespace App\Http\Controllers;

use App\Facades\ApiResponse;
use App\Http\Requests\StoreCurrencyRequest;
use App\Http\Requests\UpdateCurrencyRequest;
use App\Http\Resources\CurrencyCollection;
use App\Http\Resources\CurrencyResource;
use App\Models\Currency;
use Symfony\Component\HttpFoundation\Exception\BadRequestException;
use App\Interfaces\Controllers\v1\CurrencyControllerInterface;

class CurrencyController extends Controller implements CurrencyControllerInterface
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $currencies = Currency::paginate();
        return ApiResponse::data(new CurrencyCollection($currencies))
            ->message('')
            ->send(200);
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
            return ApiResponse::data(new CurrencyResource($currency))
                ->message(__('currency.messages.create_successfull'))
                ->send(201);
        }
    }

    /**
     * Active a resource in storage.
     */
    public function active(Currency $currency)
    {
        if ($currency->is_active) {
            throw new BadRequestException(__('currency.errors.currency_was_active'));
        }

        $currency->update(['is_active' => 1]);

        return ApiResponse::data(new CurrencyResource($currency))
            ->message(__('currency.messages.activated_successfull'))
            ->send(201);
    }

    /**
     * Deactive a resource in storage.
     */
    public function deactive(Currency $currency)
    {
        if (!$currency->is_active) {
            throw new BadRequestException(__('currency.errors.currency_was_not_active'));
        }

        $currency->update(['is_active' => 0]);

        return ApiResponse::data(new CurrencyResource($currency))
            ->message(__('currency.messages.deactivated_successfull'))
            ->send(201);
    }
}
