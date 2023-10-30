<?php

namespace App\Http\Requests;

use App\Enums\Payments\PaymentStatus;
use App\Rules\CheckCurrencyExistsAndActive;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Enum;

// TODO check request method (exm: POST) and it should just be post
class StorePaymentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
        return in_array($this->method(), $this->allowedMethods());
    }


    public function allowedMethods(): array
    {
        return ['POST'];
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'amount' => ['required', 'numeric', 'between:1,9999999999999'],
            'currency_key' => ['required', new CheckCurrencyExistsAndActive()],
        ];
    }
}
