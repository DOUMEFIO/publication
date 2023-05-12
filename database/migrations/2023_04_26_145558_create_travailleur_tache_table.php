<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('travailleur_tache', function (Blueprint $table) {
            $table->id();
            $table->foreignId('idtravailleur')->constrained('users');
            $table->foreignId('idTache')->constrained('tache');
            $table->integer('totalVues')->nullable();
            $table->string('capture')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('travailleur_tache');
    }
};
