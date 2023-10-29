<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PaymentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "user" => new UserResource($this->user),
            "amount" => $this->amount,
            "status" => $this->status,
            "currency_key" => $this->currency_key,
            "unique_id" => $this->unique_id,
            "created_at" => $this->created_at,
        ];
    }
}
