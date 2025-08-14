@extends('layouts.app')

@section('title', 'Accueil - FreeJobs.ma')

@section('content')
    <nav class="navbar">
        <a href="{{ url('/') }}" class="navbar-logo">FreeJobs.ma</a>
        <div class="navbar-links">
            <a href="{{ route('choisir.profil') }}" class="btn-primary">Créer un compte</a>
            <a href="{{ route('connexion') }}" class="btn-outline">Connexion</a>
        </div>
    </nav>
    <section class="hero-accueil">
        <div class="hero-text">
            <h1>Bienvenue sur votre <br>
                plateforme dédiée aux<br>
                <span class="accent">Entreprises & Freelances</span>
            </h1>
            <p>Trouvez le talent parfait pour propulser vos projets</p>
        </div>
        <div class="hero-image">
            <img src="{{ asset('images/imageFreejobs/logoPageAcccueil.jpg') }}" alt="FreeJobs.ma" />
        </div>
    </section>
@endsection
