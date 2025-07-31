<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
// schema pour crud et Blueprint pour la structure de la table 
return new class extends Migration
{
    
    public function up(): void
    {
        Schema::create('utilisateur', function (Blueprint $table) {
            $table->id('idUtilisateur');
            $table->string('email', 100)->unique();
            $table->string('motDePasse', 100);
            $table->string('type', 100); 
        });
    }

    
    public function down(): void
    {
        Schema::dropIfExists('utilisateur');
    }
};
