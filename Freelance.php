<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Freelance extends Model
{
    use HasFactory;

    protected $table = 'profil_freelance';

    protected $primaryKey = 'idFreelance';

    protected $fillable = [
        'idUtilisateur',
        'nom',
        'prenom',
        'titre_professionnel',
        'description',
        'tauxJournalierMoyen',
        'disponible',
        'idVille',
        'telephone',
        'urllinkedin',
        'moyenneEvaluation'
    ];

    public function utilisateur()
    {
        return $this->belongsTo(Utilisateur::class, 'idUtilisateur');
    }
}
