<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>FreeJobs.ma</title>
    <link rel="stylesheet" href="{{ asset('css/styleApp.css') }}">
</head>
<body>
    <header class="navbar">
        <div class="logo">FreeJobs<span>.ma</span></div>
        <nav class="nav-links">
            <button id="btn-freelance">Freelance</button>
            <button id="btn-entreprise">Entreprise</button>
            <button id="btn-ressources">Ressources</button>
        </nav>
        <div class="nav-actions">
            <a href="{{ route('choisir.profil') }}" class="btn-filled">Créer mon compte</a>
            <button id="btn-login" class="btn-outline">Connexion</button>
        </div>
    </header>
    <section class="hero" id="section-accueil">
        <div class="hero-text">
            <h1>Bienvenue sur votre plateforme dédiée aux <span>Entreprises & Freelances</span></h1>
            <p>Trouvez le talent parfait pour propulser vos projets</p>
        </div>
        <div class="hero-img">
            <img src="{{ asset('images/img.jpg') }}" alt="Image plateforme FreeJobs" />
        </div>
    </section>
</body>
</html>
