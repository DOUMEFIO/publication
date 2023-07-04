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
        Schema::create('tache', function (Blueprint $table) {
            $table->id();
            $table->foreignId('idClient')->constrained('users');
            $table->string("vueRecherche");
            $table->string("debut");
            $table->string("fin");
            $table->string("fichier");
            $table->string("description");
            $table->foreignId('typetache')->constrained('type_tache');
            $table->foreignId('idStatus')->constrained('status')->nullable();
            $table->string('payement')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tache');
    }
};
