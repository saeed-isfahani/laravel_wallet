<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Currency extends Model
{
    use HasFactory;

    protected $fillable = ['key', 'symbol', 'iso_code', 'is_active'];

    public function getRouteKeyName()
    {
        return 'key';
    }
}
