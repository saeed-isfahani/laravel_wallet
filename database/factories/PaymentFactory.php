<?php

namespace Database\Factories;

use App\Enums\Payments\PaymentStatus;
use App\Models\Currency;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Payment>
 */
class PaymentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'unique_id' => Str::uuid(),
            'user_id' => User::factory(1)->create()[0]->id,
            'amount' => fake()->randomDigit(),
            'status' =>  PaymentStatus::PENDING,
            'currency_key' => Currency::factory(1)->create()[0]->key
        ];
    }
}
