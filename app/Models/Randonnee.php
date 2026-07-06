<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Randonnee extends Model
{
    protected $fillable = [
        'user_id',
        'titre',
        'slug',
        'description',
        'difficulte',
        'distance_km',
        'denivele_m',
        'duree_min',
        'departement',
        'type_terrain',
        'gpx_file',
        'point_depart',
        'statut',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function avis()
    {
        return $this->hasMany(Avis::class);
    }

    public function photos()
    {
        return $this->hasMany(Photo::class);
    }

    public function favoris()
    {
        return $this->hasMany(Favori::class);
    }
}