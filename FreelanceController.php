<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Utilisateur;
use App\Models\Freelance;
use Illuminate\Support\Facades\Mail;
use App\Mail\CodeVerificationFreelance;
use App\Models\Ville;
use App\Models\SecteurActivite;
use App\Models\Competence;
use \App\Models\Langue;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class FreelanceController extends Controller
{
    public function store(Request $request)
    {
        // Valider les données du formulaire
        $validated = $request->validate([
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'email' => 'required|email|unique:utilisateur,email',
            'motDePasse' => 'required|string|min:6',
            'type' => 'required|string|in:Freelance,Client' 

        ]);
        $code = random_int(100000, 999999);
        //  Enregistrer les infos dans la session
        session([
            'freelance_data' => $validated,
            'freelance_code' => $code,
        ]);
        //  Envoyer l'email
        Mail::to($validated['email'])->send(new CodeVerificationFreelance($code));
        //  Rediriger vers la page de confirmation
        return redirect()->route('freelance.confirm.email');
    }
    public function verifyCode(Request $request)
    {
        //  Vérifier le code saisi
        $request->validate([
            'code' => 'required|digits:6'
        ]);
        if ($request->code == session('freelance_code')) {
            //  Récupérer les données de session
            $data = session('freelance_data');
            // Rediriger avec succès
            return redirect()->route('accueil')->with('success', 'Inscription validée !');
        }
        // Code incorrect
        return redirect()->back()->with('error', 'Code invalide.');
    }
    public function create()
    {
        return view('Freelance.inscription-freelance');
    }
    public function resendCode(Request $request)
    {
        $data = session('freelance_data');
        if (!$data) {
            return redirect()->route('freelance.inscription')->with('error', 'Session expirée. Veuillez recommencer.');
        }
        // Générer un nouveau code 
        $code = random_int(100000, 999999);
        // Mettre à jour le code en session
        session(['freelance_code' => $code]);
        // Renvoyer l'email
        Mail::to($data['email'])->send(new CodeVerificationFreelance($code));
        return back()->with('success', 'Un nouveau code a été envoyé à votre adresse email.');
    }
    // cette partie enregistrer les données personnelles de freelance
    public function infosSuivantes()
    {
        $villes = Ville::all();
        return view('freelance.freelance-infos-suivantes', [
            'villes' => $villes
        ]);
    }
    public function infosSuivantesStore(Request $request)
    {
        $validated = $request->validate([
            'titre_professionnel' => 'required|string|max:255',
            'description' => 'required|string|max:1000',
            'idVille' => 'required|exists:ville,idVille',
            'telephone' => 'required|string|max:20',
            'urllinkedin' => 'nullable|url|max:255',
        ]);
        // Stocker en session
        session(['freelance_infos' => $validated]);
        // Rediriger vers la page suivante
        return redirect()->route('freelance.competences');
    }
    public function showCompetences()
    {
        // récupération avec Eloquent
        $secteurs = SecteurActivite::all();
        $competences = Competence::all();
        return view('freelance.freelance-competences', compact('secteurs', 'competences'));
    }
    public function storeCompetences(Request $request)
    {
        $request->validate([
            'idSecteur' => 'required|integer|exists:secteur_activite,idSecteur',
            'competences' => 'array',
            'nouvelle_competence' => 'nullable|string|max:255',
            'typeCompetence' => 'nullable|string|max:255'
        ]);

        // Stocker idSecteur dans la session
        session(['idSecteur' => $request->idSecteur]);

        $competencesSession = session('competences_selectionnees', []);

        // Ajouter les compétences sélect
        if ($request->has('competences')) {
            foreach ($request->competences as $compId) {
                if (!in_array($compId, $competencesSession)) {
                    $competencesSession[] = $compId;
                }
            }
        }

        // Ajouter une compétence personali..
        if (!empty($request->nouvelle_competence)) {
            $competencesSession[] = [
                'nomCompetence' => $request->nouvelle_competence,
                'typeCompetence' => $request->typeCompetence,
                'idSecteur' => $request->idSecteur,
                'is_new' => true
            ];
        }

        // Mettre à jour la session
        session(['competences_selectionnees' => $competencesSession]);

        return back()->with('success', 'Compétences sauvegardées avec succès.');
    }
    // pour dernière blade 
    // Affiche la dernière page avec image, tjm et langues
    public function profile()
    {
        // Récupérer toutes les langues
        $langues = Langue::all();

        return view('freelance.finaliser', compact('langues'));
    }
    // Stocke temporairement les données de la dernière page
    public function profileStore(Request $request)
    {
        $validated = $request->validate([
            'tauxJournalierMoyen' => 'required|numeric|min:0',
            'langues' => 'required|array|min:1',
            'langues.*' => 'exists:langues,id',
        ]);
        // Stocker en session
        session(['freelance_profile' => $validated]);
        return redirect()->route('freelance.finaliser.profileStore')->with('success', 'Profil sauvegardé temporairement.');
    }
    // maintenant on stocke tous dans la base de données
    public function finaliserInscription(Request $request)
    {
        // 1. Récupérer toutes les données de la session
        $utilisateurData = session('freelance_data');
        $freelanceData = session('freelance_data');
        $freelanceInfos = session('freelance_infos');
        $competences = session('competences_selectionnees', []);
        $freelanceProfile = session('freelance_profile');
        $idSecteur = session('idSecteur');

        // 2. Créer utilisateur 

        $utilisateur = new Utilisateur();
        $utilisateur->email = $utilisateurData['email'];
        $utilisateur->motDePasse = bcrypt($freelanceData['motDePasse']);
        $utilisateur->type = $freelanceData['type'];
        $utilisateur->save();

        // 3. Créer freelance 
        $freelance = new Freelance();
        $freelance->idUtilisateur = $utilisateur->idUtilisateur;
        $freelance->nom = $freelanceData['nom'];
        $freelance->prenom = $freelanceData['prenom'];
        $freelance->titre_professionnel = $freelanceInfos['titre_professionnel'];
        $freelance->description = $freelanceInfos['description'];
        $freelance->idVille = $freelanceInfos['idVille'];
        $freelance->telephone = $freelanceInfos['telephone'];
        $freelance->urlLinkedin = $freelanceInfos['urllinkedin'];
        $freelance->tauxJournalierMoyen = $freelanceProfile['tauxJournalierMoyen'];
        $freelance->idSecteur = $idSecteur;
        $freelance->save();

        // 4. Insérer dans possede_competence
        foreach ($competences as $idCompetence) {
            DB::table('possede_competence')->insert([
                'idFreelance' => $freelance->idFreelance,
                'idCompetence' => $idCompetence
            ]);
        }

        // 5. Insérer dans freelance_langue
        foreach ($freelanceProfile['langues'] as $idLangue) {
            DB::table('freelance_langue')->insert([
                'freelance_id'  => $freelance->idFreelance, 
                'langue_id'     => $idLangue               
            ]);
        }

        // 6. Vider la session
        session()->forget([
            'freelance_data',
            'freelance_infos',
            'competences_selectionnees',
            'freelance_profile',
            'idSecteur'
        ]);

        return redirect()->route('freelance.dashboard')->with('success', 'Inscription finalisée avec succès.');
    }
}
