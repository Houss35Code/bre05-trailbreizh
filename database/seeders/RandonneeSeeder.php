<?php

namespace Database\Seeders;

use App\Models\Randonnee;
use App\Models\User;
use Illuminate\Database\Seeder;

class RandonneeSeeder extends Seeder
{
    public function run(): void
    {
        $user = User::first();

        $randonnees = [
            [
                'titre' => 'Cap Sizun — Pointe du Raz',
                'slug' => 'cap-sizun-pointe-du-raz',
                'description' => 'Une randonnée spectaculaire le long des falaises du Cap Sizun jusqu\'à la mythique Pointe du Raz, point le plus à l\'ouest de la France métropolitaine.',
                'difficulte' => 'moyen',
                'distance_km' => 12.5,
                'denivele_m' => 280,
                'duree_min' => 240,
                'departement' => 'finistere',
                'type_terrain' => 'cote',
                'statut' => 'publie',
            ],
            [
                'titre' => 'Monts d\'Arrée — Roc\'h Trévezel',
                'slug' => 'monts-darree-roch-trevezel',
                'description' => 'Le point culminant de Bretagne offre un panorama exceptionnel sur la lande et les tourbières. Un parcours sauvage et mystérieux au cœur du Parc Naturel Régional d\'Armorique.',
                'difficulte' => 'difficile',
                'distance_km' => 18.0,
                'denivele_m' => 420,
                'duree_min' => 360,
                'departement' => 'finistere',
                'type_terrain' => 'montagne',
                'statut' => 'publie',
            ],
            [
                'titre' => 'GR34 — Côte de Granit Rose',
                'slug' => 'gr34-cote-de-granit-rose',
                'description' => 'La célèbre Côte de Granit Rose avec ses rochers aux formes étranges. Un sentier côtier magnifique entre Perros-Guirec et Trégastel.',
                'difficulte' => 'facile',
                'distance_km' => 15.0,
                'denivele_m' => 180,
                'duree_min' => 300,
                'departement' => 'cotes-darmor',
                'type_terrain' => 'cote',
                'statut' => 'publie',
            ],
            [
                'titre' => 'Forêt de Brocéliande',
                'slug' => 'foret-de-broceliande',
                'description' => 'La forêt légendaire de Brocéliande, terre de Merlin et des fées. Un parcours enchanté à travers les chênes centenaires et les étangs mystérieux.',
                'difficulte' => 'facile',
                'distance_km' => 10.0,
                'denivele_m' => 120,
                'duree_min' => 180,
                'departement' => 'ille-et-vilaine',
                'type_terrain' => 'foret',
                'statut' => 'publie',
            ],
            [
                'titre' => 'Golfe du Morbihan — Tour de l\'île aux Moines',
                'slug' => 'golfe-morbihan-ile-aux-moines',
                'description' => 'Le tour complet de la plus grande île du Golfe du Morbihan. Des paysages méditerranéens au cœur de la Bretagne, entre mimosas et chênes verts.',
                'difficulte' => 'facile',
                'distance_km' => 9.0,
                'denivele_m' => 80,
                'duree_min' => 150,
                'departement' => 'morbihan',
                'type_terrain' => 'cote',
                'statut' => 'publie',
            ],
            [
                'titre' => 'Presqu\'île de Crozon — Pointe de Pen-Hir',
                'slug' => 'presquile-crozon-pen-hir',
                'description' => 'Les falaises vertigineuses de la Presqu\'île de Crozon avec une vue imprenable sur l\'Atlantique. Un des plus beaux panoramas de Bretagne.',
                'difficulte' => 'moyen',
                'distance_km' => 14.0,
                'denivele_m' => 320,
                'duree_min' => 270,
                'departement' => 'finistere',
                'type_terrain' => 'cote',
                'statut' => 'publie',
            ],
        ];

        foreach ($randonnees as $data) {
            Randonnee::create(array_merge($data, ['user_id' => $user->id]));
        }
    }
}