<?php

namespace App\Rules;

use App\Models\Currency;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class CheckCurrencyExistsAndActive implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $currency = Currency::query()->where('key', $value)->first();
        if (!$currency) {
            $fail('payment.errors.currency_key_not_found_or_deactive')->translate();
        }
    }
}
