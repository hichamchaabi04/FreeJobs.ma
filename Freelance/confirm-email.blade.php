@extends('layouts.app')

@section('title', 'Vérification Email - FreeJobs.ma')

@section('content')
<nav class="navbar">
    <a href="{{ url('/') }}" class="navbar-logo">FreeJobs.ma</a>
</nav>
<section class="confirm-email-container">
    <div class="confirm-box">
        <h2>Vérification de votre email</h2>
        <p>Nous avons envoyé un code à 6 chiffres à votre adresse email :</p>
        <strong>{{ session('freelance_data.email') ?? 'exemple@email.com' }}</strong>

        <form id="code-form">
            <input type="text" name="code" maxlength="6" placeholder="Entrez le code" required>

            <div class="buttons">
                <button type="button" id="btn-retour">Retour</button>
                <button type="button" id="btn-suivant">Suivant</button>
            </div>
        </form>

        <form method="POST" action="{{ route('freelance.resend.code') }}">
            @csrf
            <button type="submit" class="resend">Renvoyer le code</button>
        </form>

        @if(session('error'))
            <p class="error">{{ session('error') }}</p>
        @endif
    </div>
</section>

<script>
    document.getElementById('btn-retour').addEventListener('click', function () {
        window.location.href = "{{ route('freelance.inscription') }}";
    });

    document.getElementById('btn-suivant').addEventListener('click', function () {
        const code = document.querySelector('input[name="code"]').value;
        if (code.length === 6) {
            window.location.href = "{{ route('freelance.infos.suivantes') }}";
        } else {
            alert("Veuillez entrer un code de 6 chiffres.");
        }
    });
</script>
@endsection
