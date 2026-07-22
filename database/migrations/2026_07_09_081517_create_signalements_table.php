<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('signalements', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->morphs('signalable');
            $table->text('motif');
            $table->string('statut')->default('en_attente'); // en_attente, traite, ignore
            $table->timestamps();

            $table->unique(['user_id', 'signalable_type', 'signalable_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('signalements');
    }
};