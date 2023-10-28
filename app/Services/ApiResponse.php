<?php

namespace App\Services;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Support\Collection;
use Symfony\Component\HttpFoundation\Response;

class ApiResponse
{
    private mixed $data = [];
    private array $errors = [];
    private string $messages = '';

    /**
     * message
     *
     * @param mixed $data
     * @return ApiResponse
     */
    public function data(mixed $data): ApiResponse
    {
        $this->data = $data;

        return $this;
    }

    /**
     * errors
     *
     * @param array|null $errors
     * @return ApiResponse
     */
    public function errors(?array $errors = []): ApiResponse
    {
        $this->errors = $errors;

        return $this;
    }

    /**
     * message
     *
     * @param string $message
     * @return ApiResponse
     */
    public function message(string $message): ApiResponse
    {
        $this->messages = $message;

        return $this;
    }

    /**
     * send
     *
     * @param int $statusCode
     * @return JsonResponse
     */
    public function send(int $statusCode = Response::HTTP_OK): JsonResponse
    {
        return response()->json([
            'message' => $this->messages,
            'errors' => $this->errors,
            'data' => $this->data,
        ], $statusCode);
    }
}
