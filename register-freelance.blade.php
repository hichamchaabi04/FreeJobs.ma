<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Inscription Freelance - FreeJobs</title>
    <link rel="stylesheet" href="{{ asset('css/styleInscFreelance.css') }}">
</head>

<body>

    <!-- HEADER AVEC RETOUR -->
    <header class="header">
        <div class="logo">
            <a href="{{ route('accueil') }}">FreeJobs<span>.ma</span></a>
        </div>
    </header>

    <!-- FORMULAIRE INSCRIPTION FREELANCE -->
    <section class="freelance-register">
        <h2>Inscription Freelance</h2>
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form id="freelance-form" method="POST" action="{{ route('freelance.inscription.submit') }}">
            @csrf
            <input type="text" name="nom" placeholder="Nom" required>
            <input type="text" name="prenom" placeholder="Prénom" required>
            <input type="email" name="email" placeholder="Adresse email" required>
            <input type="password" name="password" placeholder="Mot de passe" required>
            <input type="hidden" name="type" value="Freelance">

            <div class="buttons">
                <button type="button" id="btn-retour">Retour</button>
                <button type="submit" id="btn-suivant">Suivant</button>
            </div>
        </form>

    </section>

    <script src="{{ asset('js/forPageRegisterFree.js') }}"></script>
</body>

</html>
