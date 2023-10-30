<?php

namespace App\Console\Commands;

use App\Jobs\FetchAndFillRatesWithNavasanJob;
use Illuminate\Console\Command;

class FetchAndFillRatesCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:fetch-and-fill-rates-command';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Fetch all rates from api and create a record for each currency in rates table';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        FetchAndFillRatesWithNavasanJob::dispatch();
    }
}
