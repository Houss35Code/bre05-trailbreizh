<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Topic extends Model
{
    protected $fillable = [
        'user_id',
        'titre',
        'contenu',
        'categorie',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function reponses()
    {
        return $this->hasMany(Reponse::class);
    }
}