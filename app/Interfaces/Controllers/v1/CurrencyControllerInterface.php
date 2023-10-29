<?php

namespace App\Interfaces\Controllers\V1;

use App\Http\Requests\StoreCurrencyRequest;
use App\Models\Currency;

interface CurrencyControllerInterface
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     * @OA\Get(
     *     path="/api/v1/currencies",
     *     operationId="getListCurrency",
     *     tags={"Currency"},
     *     summary="summary",
     *     description="get list of Currency",
     *
     *     security={{"bearerAuth":{}}},
     *     @OA\Response(response=200,description="Successful operation"),
     *     @OA\Response(response=201,description="Successful operation"),
     *     @OA\Response(response=202,description="Successful operation"),
     *     @OA\Response(response=204,description="Successful operation"),
     *     @OA\Response(response=400,description="Bad Request"),
     *     @OA\Response(response=401,description="Unauthenticated"),
     *     @OA\Response(response=403,description="Forbidden"),
     *     @OA\Response(response=404,description="Resource Not Found")
     * )
     */
    public function index();


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     * @OA\Post(
     *     path="/api/v1/currencies",
     *     operationId="storeCurrency",
     *     tags={"Currency"},
     *     summary="currency",
     *     description="store currency",
     *     @OA\RequestBody(
     *         @OA\JsonContent(),
     *         @OA\MediaType(
     *            mediaType="multipart/form-data",
     *            @OA\Schema(
     *                  type="object",
     *                  required={"key","symbol","iso_code"},
     *                  @OA\Property(property="key", type="text"),
     *                  @OA\Property(property="symbol", type="text"),
     *                  @OA\Property(property="iso_code", type="text"),
     *            ),
     *        ),
     *    ),
     *
     *      security={{"bearerAuth":{}}},
     *      @OA\Response(response=200,description="Successful operation"),
     *      @OA\Response(response=201,description="Successful operation"),
     *      @OA\Response(response=202,description="Successful operation"),
     *      @OA\Response(response=204,description="Successful operation"),
     *      @OA\Response(response=400,description="Bad Request"),
     *      @OA\Response(response=401,description="Unauthenticated"),
     *      @OA\Response(response=403,description="Forbidden"),
     *      @OA\Response(response=404,description="Resource Not Found")
     * )
     */
    public function store(StoreCurrencyRequest $request);

    /**
     * Active an instance of the resource.
     *
     * @return \Illuminate\Http\Response
     * @OA\Post(
     *     path="/api/v1/currencies/{key}/active",
     *     operationId="activeCurrency",
     *     tags={"Currency"},
     *     summary="currency",
     *     description="active currency",
     *     @OA\RequestBody(
     *         @OA\JsonContent(),
     *         @OA\MediaType(
     *            mediaType="multipart/form-data",
     *            @OA\Schema(
     *                  type="object",
     *                  required={"key"},
     *                  @OA\Property(property="key", type="text"),
     *            ),
     *        ),
     *    ),
     *
     *      security={{"bearerAuth":{}}},
     *      @OA\Response(response=200,description="Successful operation"),
     *      @OA\Response(response=201,description="Successful operation"),
     *      @OA\Response(response=202,description="Successful operation"),
     *      @OA\Response(response=204,description="Successful operation"),
     *      @OA\Response(response=400,description="Bad Request"),
     *      @OA\Response(response=401,description="Unauthenticated"),
     *      @OA\Response(response=403,description="Forbidden"),
     *      @OA\Response(response=404,description="Resource Not Found")
     * )
     */
    public function active(Currency $currency);

    /**
     * Deactive an instance of the resource.
     *
     * @return \Illuminate\Http\Response
     * @OA\Post(
     *     path="/api/v1/currencies/{key}/deactive",
     *     operationId="deactiveCurrency",
     *     tags={"Currency"},
     *     summary="currency",
     *     description="deactive
     *  currency",
     *     @OA\RequestBody(
     *         @OA\JsonContent(),
     *         @OA\MediaType(
     *            mediaType="multipart/form-data",
     *            @OA\Schema(
     *                  type="object",
     *                  required={"key"},
     *                  @OA\Property(property="key", type="text"),
     *            ),
     *        ),
     *    ),
     *
     *      security={{"bearerAuth":{}}},
     *      @OA\Response(response=200,description="Successful operation"),
     *      @OA\Response(response=201,description="Successful operation"),
     *      @OA\Response(response=202,description="Successful operation"),
     *      @OA\Response(response=204,description="Successful operation"),
     *      @OA\Response(response=400,description="Bad Request"),
     *      @OA\Response(response=401,description="Unauthenticated"),
     *      @OA\Response(response=403,description="Forbidden"),
     *      @OA\Response(response=404,description="Resource Not Found")
     * )
     */
    public function deactive(Currency $currency);
}
