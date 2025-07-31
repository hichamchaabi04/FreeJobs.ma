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
        Schema::create('profil_freelance', function (Blueprint $table) {
            $table->id('idFreelance');
            $table->unsignedBigInteger('idUtilisateur');
            $table->string('nom', 100);
            $table->string('prenom', 100);
            $table->string('titre_professionnel', 255)->nullable();
            $table->string('description',1000)->nullable();
            $table->string('tauxJournalierMoyen', 100)->nullable();
            $table->string('disponible',10)->nullable();
            $table->unsignedBigInteger('idVille')->nullable();
            $table->string('telephone', 20)->nullable();
            $table->string('urllinkedin', 100)->nullable();
            $table->float('moyenneEvaluation')->nullable();
            $table->timestamps()->nullable();

            $table->foreign('idUtilisateur')->references('idUtilisateur')->on('utilisateur')->onDelete('cascade');
            $table->foreign('idVille')->references('idVille')->on('ville')->nullable();
        });

    }

    
    public function down(): void
    {
        Schema::dropIfExists('freelances');
    }
};


