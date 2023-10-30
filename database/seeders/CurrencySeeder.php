<?php

namespace Database\Seeders;

use App\Models\Currency;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CurrencySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $currencies = [
            [
                'key' => 'rial',
                'symbol' => '﷼',
                'iso_code' => 'irr',
                'is_active' => 1
            ],
            [
                'key' => 'dollar',
                'symbol' => '$',
                'iso_code' => 'usd',
                'is_active' => 1
            ],
            [
                'key' => 'euro',
                'symbol' => '€',
                'iso_code' => 'irr',
                'is_active' => 1
            ],
            [
                'key' => 'lira',
                'symbol' => '₺',
                'iso_code' => 'try',
                'is_active' => 1
            ]
        ];

        foreach ($currencies as $currency) {
            Currency::create($currency);
        }
    }
}
