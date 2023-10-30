<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Enums\Payments\PaymentStatus;
use Illuminate\Support\Str;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;
use Illuminate\Database\Eloquent\SoftDeletes;

class Payment extends Model
{
    use HasFactory, SoftDeletes, LogsActivity;

    protected $fillable = ['user_id', 'amount', 'status', 'currency_key'];
    protected $hidden = ['id'];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['user_id', 'amount', 'status', 'currency_key']);
        // Chain fluent methods for configuration options
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    protected $casts = [
        'status' => PaymentStatus::class
    ];

    public function getRouteKeyName()
    {
        return 'unique_id';
    }

    protected static function booted()
    {
        static::creating(function ($payment) {
            $payment->unique_id = Str::uuid()->toString();
        });
    }
}
