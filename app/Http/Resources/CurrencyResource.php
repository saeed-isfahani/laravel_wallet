<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CurrencyResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "key" => $this->key,
            "symbol" => $this->symbol,
            "iso_code" => $this->iso_code,
            "is_active" => $this->is_active,
        ];
    }
}
