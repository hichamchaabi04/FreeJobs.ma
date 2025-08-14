<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <!-- Titre : si une vue définit une section 'title' elle l'utilise, sinon "FreeJobs.ma" -->
    <title>@yield('title', 'FreeJobs.ma')</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/pages/accueil.css') }}">
    <link rel="stylesheet" href="{{ asset('css/pages/inscription-freelance.css') }}">
    <link rel="stylesheet" href="{{ asset('css/pages/inscription-entreprise.css') }}">
    <link rel="stylesheet" href="{{ asset('css/pages/choose-profile.css') }}">
    <link rel="stylesheet" href="{{ asset('css/pages/confirm-email.css') }}">
    <link rel="stylesheet" href="{{ asset('css/pages/freelance-infos.css') }}">
    <link rel="stylesheet" href="{{ asset('css/pages/competence.css') }}">
    <link rel="stylesheet" href="{{ asset('css/pages/profile.css') }}">




</head>

<body>

    <main class="content">
        @yield('content')
    </main>

</body>

</html>
