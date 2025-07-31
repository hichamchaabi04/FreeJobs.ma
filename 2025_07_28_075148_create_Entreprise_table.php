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
        Schema::create('profil_Entreprise', function (Blueprint $table) {
            $table->id('idEntreprise');
            $table->unsignedBigInteger('idUtilisateur');
            $table->string('nomEntreprise', 100);
            $table->string('adresse', 100);
            $table->string('secteurActivite',100);
            $table->string('descriptionEntreprise',1000);
            $table->unsignedBigInteger('idVille');
            $table->string('telephone', 20);
            $table->timestamps();

            $table->foreign('idUtilisateur')->references('idUtilisateur')->on('utilisateur')->onDelete('cascade');
            $table->foreign('idVille')->references('idVille')->on('ville');
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clients');
    }
};
