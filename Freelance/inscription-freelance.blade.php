@extends('layouts.app')

@section('title', 'Inscription Freelance - FreeJobs.ma')

@section('content')

<nav class="navbar">
    <a href="{{ url('/') }}" class="navbar-logo">FreeJobs.ma</a>
</nav>

<section class="freelance-register-container">
    <div class="form-side">
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
            <input type="motDePasse" name="motDePasse" placeholder="Mot de passe" required>
            <input type="hidden" name="type" value="Freelance">

            <div class="buttons">
                <button type="button" id="btn-retour">Retour</button>
                <button type="submit" id="btn-suivant">Suivant</button>
            </div>
        </form>
    </div>

    <div class="image-side">
        <img src="{{ asset('images/imageFreejobs/freelance.jpg') }}" alt="Illustration Freelance">
    </div>
</section>
<script src="{{ asset('js/inscriptionFreelance.js') }}"></script>

@endsection
