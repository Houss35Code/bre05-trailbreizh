<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Avis extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'user_id',
        'randonnee_id',
        'note',
        'commentaire',
        'signale',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function randonnee()
    {
        return $this->belongsTo(Randonnee::class);
    }

    public function signalements()
    {
        return $this->morphMany(Signalement::class, 'signalable');
    }
}