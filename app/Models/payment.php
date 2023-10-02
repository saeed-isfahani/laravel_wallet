<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class payment extends Model
{
    use HasFactory;

    protected $fillable = ['amount', 'status'];

    // public function setTitleAttribute($title)
    // {
    //     $this->attributes['title'] = $title;
    //     $this->attributes['slug'] = str_replace(' ', '-', $title);
    // }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // public function comments()
    // {
    //     return $this->hasMany(Comment::class);
    // }
}
