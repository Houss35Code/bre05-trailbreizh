<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    protected $fillable = [
        'randonnee_id',
        'user_id',
        'filename',
        'alt',
    ];

    public function randonnee()
    {
        return $this->belongsTo(Randonnee::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}