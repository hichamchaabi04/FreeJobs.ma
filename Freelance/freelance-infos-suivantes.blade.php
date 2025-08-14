@extends('layouts.app')

@section('title', 'Infos Freelance - FreeJobs.ma')

@section('content')
<nav class="navbar">
    <a href="{{ url('/') }}" class="navbar-logo">FreeJobs.ma</a>
</nav>

<section class="freelance-info-form">
    <h2>Informations personnelles</h2>

    <form id="freelance-infos-form" action="{{ route('freelance.infos.store') }}" method="POST">
        @csrf

        <input type="text" name="titre_professionnel" placeholder="Titre professionnel" required>
        <textarea name="description" placeholder="Description du profil" required></textarea>

        <select name="idVille" required>
            <option value="">Sélectionnez une ville</option>
            @foreach($villes as $ville)
                <option value="{{ $ville->idVille }}">{{ $ville->nomVille }}, {{ $ville->pays }}</option>
            @endforeach
        </select>
        <input type="text" name="telephone" placeholder="Téléphone" required>
        <input type="url" name="urllinkedin" placeholder="URL LinkedIn">

        <div class="buttons">
            <button type="button" id="btn-suivant">Suivant</button>
        </div>
    </form>
</section>

<script src="{{ asset('js/freelance-infos-suivantes.js') }}"></script>

@endsection
