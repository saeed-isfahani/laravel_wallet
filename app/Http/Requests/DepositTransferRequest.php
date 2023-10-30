<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DepositTransferRequest extends FormRequest
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
            'from_user' => ['required', 'exists:users,id'],
            'to_user' => ['required', 'different:from', 'exists:users,id'],
            'amount' => ['required', 'numeric', 'between:1,9999999999999'],
            'currency_key' => ['required', 'exists:currencies,key']
        ];
    }
}
