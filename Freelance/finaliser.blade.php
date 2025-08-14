@extends('layouts.app')

@section('title', 'Finalisation Profil Freelance - FreeJobs.ma')

@section('content')
<nav class="navbar bg-light shadow-sm px-4">
    <a href="{{ url('/') }}" class="navbar-logo fw-bold text-success fs-4">FreeJobs.ma</a>
</nav>

<div class="container py-5">
    <h2 class="mb-4 fw-bold">Finaliser mon profil</h2>

    @if ($errors->any())
        <div class="alert alert-danger shadow-sm">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- Formulaire sauvegarde en session --}}
    <form action="{{ route('freelance.profile') }}" method="POST" enctype="multipart/form-data">
        @csrf
        {{-- Langues --}}
        <div class="mb-4">
            <label for="langues" class="form-label fw-bold">Langues de travail</label>
            <select name="langues[]" id="langues" class="form-select" multiple required>
                @foreach ($langues as $langue)
                    <option value="{{ $langue->id }}">{{ $langue->nomLangue }}</option>
                @endforeach
            </select>
            <div class="form-text">Maintenez Ctrl (Windows) ou Cmd (Mac) pour sélectionner plusieurs langues.</div>
        </div>

        {{-- Taux journalier moyen --}}
        <div class="mb-4">
            <label for="tauxJournalierMoyen" class="form-label fw-bold">Taux journalier moyen (en DH)</label>
            <div class="input-group">
                <input type="number" name="tauxJournalierMoyen" id="tauxJournalierMoyen" class="form-control"
                    placeholder="Ex: 1200" min="0" required>
                <span class="input-group-text">DH</span>
            </div>
        </div>

        {{-- Bouton sauvegarder temporairement --}}
        <div class="text-end mb-4">
            <button type="submit" class="btn btn-success px-4 py-2 fw-bold">
                Sauvegarder temporairement
            </button>
        </div>
    </form>

    {{-- Formulaire pour finaliser l'inscription (visible seulement si la session existe) --}}
    @if(session('freelance_profile'))
        <form action="{{ route('freelance.finaliser') }}" method="POST">
            @csrf
            <button type="submit" class="btn btn-primary px-4 py-2 fw-bold">
                Finaliser mon inscription
            </button>
        </form>
    @endif
</div>
@endsection
