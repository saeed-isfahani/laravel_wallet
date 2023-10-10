<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use app\Enums\Payments\Status;
use Illuminate\Support\Str;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = ['amount', 'status', 'currency'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    protected $casts = [
        'status' => Status::class
    ];

    protected static function booted()
    {
        static::creating(function ($payment) {
            $payment->unique_id = Str::uuid()->toString();
        });
    }
}
