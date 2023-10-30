<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Http;
use App\Models\Currency;
use App\Models\Rate;

class FetchAndFillRatesWithNavasanJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $url = config('settings.apis.navasan.url') . config('settings.apis.navasan.key');
        $ratesCollection = json_decode(Http::get($url));
        $currencies = Currency::where('iso_code', '<>', 'irr')->get();
        foreach ($currencies as $currency) {
            Rate::create([
                'currency_key' => $currency->key,
                'rate' => $ratesCollection->{$currency->iso_code}->value * 10,
                'equal_currency_key' => 'rial',
            ]);
        }
    }
}
