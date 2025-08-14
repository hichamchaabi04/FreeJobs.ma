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