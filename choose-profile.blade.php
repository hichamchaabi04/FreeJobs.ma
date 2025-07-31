<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Choisissez votre profil</title>
    <link rel="stylesheet" href="{{ asset('css/styleApp.css') }}">
</head>
<body>

    <header class="navbar">
        <div class="logo">
            <a href="{{ route('accueil') }}" style="text-decoration: none; color: inherit;">FreeJobs<span>.ma</span></a>
        </div>
        <a href="{{ route('strategy') }}">Découvrir FreeJobs</a>
    </header>
    <section class="choose-account" id="choose-account">
        <div class="welcome">
            <span class="badge">Bonjour !</span>
            <h2>Choisissez votre profil </h2>
        </div>
        <div class="account-options">
            <div class="card entreprise-card" id="card-entreprise" data-href="{{ route('entreprise.inscription') }}">
                <img class="card-img" src="{{ asset('images/entre.png') }}" alt="image de entreprise" />
                <h3>Entreprise</h3>
                <p>Accédez à un réseau de freelances qualifiés pour réaliser vos projets.</p>
            </div>
            <div class="card" id="card-freelance" data-href="{{ route('freelance.inscription') }}">
                <img src="{{ asset('images/free.png') }}" alt="Image freelance" />
                <h3>Freelance</h3>
                <p>Rejoignez la plateforme et trouvez des missions adaptées à vos compétences.</p>
            </div>
        </div>
    </section>
    <script src="{{ asset('js/app.js') }}"></script>
</body>

</html>
