<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Utilisateur extends Model
{
    

    protected $table = 'utilisateur'; 
    protected $primaryKey = 'idUtilisateur'; 

    protected $fillable = [
        'email',
        'motDePasse',
        'type',
    ];

    public function profilFreelance()
    {
        return $this->hasOne(Freelance::class, 'idUtilisateur');
    }
}

