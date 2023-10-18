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
        Schema::create('tache_zone', function (Blueprint $table) {
            $table->id();
            $table->foreignId('idTache')->constrained('tache');
            $table->unsignedBigInteger('idPay')->nullable();
            $table->foreign('idPay')->references('id')->on('pays')->onDelete('cascade');
            $table->unsignedBigInteger('idDepartement')->nullable();
            $table->foreign('idDepartement')->references('id')->on('departements')->onDelete('cascade');
            $table->unsignedBigInteger('idVille')->nullable();
            $table->foreign('idVille')->references('id')->on('villes')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tache_zone');
    }
};
