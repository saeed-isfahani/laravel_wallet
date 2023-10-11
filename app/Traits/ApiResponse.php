<?php

namespace App\Traits;

use Illuminate\Http\JsonResponse;

trait ApiResponse
{
    /**
     * success
     *
     * @param mixed $data
     * @param string $message
     * @param int $status
     * @return JsonResponse
     */
    public function successResponse(mixed $data = [], string $message = '', int $status = 200): JsonResponse
    {
        return response()->json([
            'message' => $message,
            'data' => $data,
            'errors' => [],
        ], $status);
    }

    /**
     * error
     *
     * @param array $errors
     * @param string $message
     * @param int $status
     * @return JsonResponse
     */
    public function errorResponse(array $errors = [], string $message = '', int $status = 500): JsonResponse
    {
        return response()->json([
            'message' => $message,
            'data' => [],
            'errors' => $errors,
        ], $status);
    }
}