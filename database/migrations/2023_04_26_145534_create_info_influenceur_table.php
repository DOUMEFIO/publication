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
        Schema::create('info_influenceur', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_User')->constrained('users');
            $table->string('tel');
            $table->integer('nbr_vue_moyen');
            $table->string('sexe');
            $table->foreignId('id_pay')->constrained('pays');
            $table->foreignId('id_departement')->constrained('departements');
            $table->foreignId('id_ville')->constrained('villes');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('info_influenceur');
    }
};
