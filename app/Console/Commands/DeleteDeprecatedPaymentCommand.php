<?php

namespace App\Console\Commands;

use App\Enums\Payments\PaymentStatus;
use App\Jobs\DeleteDeprecatedPaymentJob;
use App\Models\Payment;
use Carbon\Carbon;
use Illuminate\Console\Command;

class DeleteDeprecatedPaymentCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:delete-deprecated-payment';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Delete all pending paymnets they doesnt approved or rejected in last 24h';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        Payment::where('status', PaymentStatus::PENDING)
            ->where('created_at', '<', Carbon::now()->subHours(config('settings.payments.delete_deprecated_payment_after_hours')))
            ->chunk(config('settings.payments.payments_should_delete_count'), function ($payments) {
                DeleteDeprecatedPaymentJob::dispatch($payments->pluck('id')->toArray());
            });
    }
}
