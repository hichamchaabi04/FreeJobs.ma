@extends('layouts.app')

@section('title', 'Compétences Freelance - FreeJobs.ma')

@section('content')
    <nav class="navbar">
        <a href="{{ url('/') }}" class="navbar-logo">FreeJobs.ma</a>
    </nav>
    <div class="container py-5">
        <h2 class="mb-4">Mes Compétences</h2>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <form id="freelance-competences-form" action="{{ route('freelance.competences') }}" method="POST"
            class="card p-4 shadow-sm">
            @csrf

            <div class="mb-3">
                <label for="idSecteur" class="form-label fw-bold">Secteur d'activité</label>
                <select name="idSecteur" id="idSecteur" class="form-select" required>
                    <option value=""> Sélectionnez un secteur </option>
                    @foreach ($secteurs as $secteur)
                        <option value="{{ $secteur->idSecteur }}">{{ $secteur->nomSecteur }}</option>
                    @endforeach
                </select>
            </div>

            <div id="competences-container" class="row g-2"></div>

            <div class="mt-3">
                <button type="button" id="btn-add-competence" class="btn btn-outline-primary">+ Ajouter une compétence
                    personnalisée</button>
            </div>

            <div id="new-competence-form" class="mt-3 p-3 border rounded bg-light" style="display:none;">
                <div class="mb-2">
                    <label for="nouvelle_competence" class="form-label">Nom de la compétence :</label>
                    <input type="text" name="nouvelle_competence" id="nouvelle_competence" class="form-control"
                        placeholder="Ex: Node.js">
                </div>
                <input type="hidden" name="typeCompetence" id="typeCompetence">
            </div>

            <div class="mt-4 d-flex justify-content-between">
                <button type="submit" class="btn btn-success">💾 Sauvegarder</button>
                <a href="{{ route('freelance.finaliser.profileStore') }}" class="btn btn-primary">➡ Suivant</a>
            </div>
        </form>
    </div>

    <script>
    const allCompetences = @json($competences);

    const selectSecteur = document.getElementById('idSecteur');
    const container = document.getElementById('competences-container');
    const btnAddCompetence = document.getElementById('btn-add-competence');
    const newCompetenceForm = document.getElementById('new-competence-form');
    const inputTypeCompetence = document.getElementById('typeCompetence');

    selectSecteur.addEventListener('change', function () {
        const secteurId = parseInt(this.value);
        container.innerHTML = '';

        if (!secteurId) {
            container.innerHTML = '<p class="text-muted">Veuillez sélectionner un secteur.</p>';
            return;
        }

        // Filtrer par idSecteur
        let filtered = allCompetences.filter(c => c.idSecteur === secteurId);

        if (filtered.length === 0) {
            container.innerHTML = '<p class="text-muted">Aucune compétence disponible pour ce secteur.</p>';
        } else {
            filtered.forEach(c => {
                container.innerHTML += `
                    <div class="col-md-4">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="competences[]" value="${c.id}" id="comp-${c.id}">
                            <label class="form-check-label" for="comp-${c.id}">${c.nomCompetence}</label>
                        </div>
                    </div>
                `;
            });
        }

        // Si besoin de stocker typeCompetence du premier élément filtré
        inputTypeCompetence.value = filtered.length > 0 ? filtered[0].typeCompetence : '';

        newCompetenceForm.style.display = 'none';
    });

    btnAddCompetence.addEventListener('click', function () {
        if (!selectSecteur.value) {
            alert("Veuillez d'abord choisir un secteur.");
            return;
        }
        newCompetenceForm.style.display = (newCompetenceForm.style.display === 'none') ? 'block' : 'none';
    });
</script>

@endsection
