<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('randonnees', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('titre');
            $table->string('slug')->unique();
            $table->text('description');
            $table->enum('difficulte', ['facile', 'moyen', 'difficile', 'expert']);
            $table->decimal('distance_km', 5, 2);
            $table->integer('denivele_m');
            $table->integer('duree_min');
            $table->enum('departement', ['finistere', 'cotes-darmor', 'morbihan', 'ille-et-vilaine']);
            $table->enum('type_terrain', ['cote', 'foret', 'montagne', 'campagne']);
            $table->string('gpx_file')->nullable();
            $table->string('point_depart')->nullable();
            $table->enum('statut', ['en_attente', 'publie', 'refuse'])->default('en_attente');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('randonnees');
    }
};