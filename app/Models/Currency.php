<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Currency extends Model
{
    use HasFactory;

    protected $fillable = ['key', 'symbol', 'iso_code', 'is_active'];

    protected static function booted()
    {
        static::addGlobalScope('isActive', function (Builder $builder) {
            $builder->where('is_active', true);
        });
    }

    public function getRouteKeyName()
    {
        return 'key';
    }

    public function paymetns()
    {
        return $this->hasMany(Payments::class, 'key', 'currency_key');
    }

    public function transactions()
    {
        return $this->hasMany(Transaction::class, 'key', 'currency_key');
    }
}
