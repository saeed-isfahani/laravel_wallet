<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use Faker\Provider\ar_EG\Payment;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Laravel\Sanctum\HasApiTokens;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject
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
        'balance'
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

    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }
    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }

    public function Payments()
    {
        return $this->hasMany(Payment::class);
    }

    public function Transactions()
    {
        return $this->hasMany(Transaction::class);
    }

    public function updateBalance(): collection
    {
        $totalAmount = $this->transactions()
            ->select('currency_key', DB::raw('SUM(amount) as total_amount'))
            ->groupBy('currency_key')
            ->pluck('total_amount', 'currency_key');

        $this->update([
            'balance' => json_encode($totalAmount->jsonSerialize())
        ]);

        return $totalAmount;
    }

    public function getBalance(String $currency): int
    {
        $totalAmount = $this->transactions()
            ->where('currency_key', $currency)
            ->sum('amount');

        return $totalAmount;
    }
}
