document.querySelectorAll('.profile-card').forEach(card => {
    card.addEventListener('click', () => {
        const href = card.getAttribute('data-href');
        if (href) window.location.href = href;
    });
});
