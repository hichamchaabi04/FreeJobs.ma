document.addEventListener("DOMContentLoaded", function () {
    const entrepriseCard = document.getElementById("card-entreprise");
    const freelanceCard = document.getElementById("card-freelance");

    if (entrepriseCard) {
        entrepriseCard.addEventListener("click", function () {
            window.location.href = entrepriseCard.dataset.href;
        });
    }

    if (freelanceCard) {
        freelanceCard.addEventListener("click", function () {
            window.location.href = freelanceCard.dataset.href;
        });
    }
});
