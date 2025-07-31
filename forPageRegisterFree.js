document.addEventListener("DOMContentLoaded", function () {
    const btnRetour = document.getElementById("btn-retour");
    if (btnRetour) {
        btnRetour.addEventListener("click", function () {
            window.history.back();
        });
    }
});