<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use Faker\Provider\ar_EG\Payment;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function Payments()
    {
        return $this->hasMany(Payment::class);
    }

    public function Transactions()
    {
        return $this->hasMany(Transaction::class);
    }

    public function updateBalance()
    {
        $totalAmount = $this->transactions()
            ->select('currency', DB::raw('SUM(amount) as total_amount'))
            ->groupBy('currency')
            ->pluck('total_amount', 'currency');

        $this->update([
            'balance' => json_encode($totalAmount->jsonSerialize())
        ]);

        return $totalAmount;
    }

    public function getBalance(String $currency): int
    {
        $totalAmount = $this->transactions()
            ->where('currency', $currency)
            ->sum('amount');

        return $totalAmount;
    }
}
