
document.addEventListener('DOMContentLoaded', function () {

    // Season Card Interaction
    const seasonCards = document.querySelectorAll('.season-card-action');
    const episodeContainer = document.getElementById('episodes-container');
    const seasonTitle = document.getElementById('selected-season-title');

    seasonCards.forEach(card => {
        card.addEventListener('click', function (e) {
            e.preventDefault();

            // Remove active class from all
            seasonCards.forEach(c => c.classList.remove('active', 'border-primary'));

            // Add active to clicked
            this.classList.add('active', 'border-primary');

            const seasonId = this.dataset.season;
            const seasonNum = this.dataset.seasonNum;

            // Show episodes for this season
            const allEpisodes = document.querySelectorAll('.season-episodes');
            allEpisodes.forEach(ep => ep.classList.add('d-none'));

            const targetEpisodes = document.getElementById('season-' + seasonNum);
            if (targetEpisodes) {
                targetEpisodes.classList.remove('d-none');
                targetEpisodes.classList.add('fade-in');
                seasonTitle.textContent = 'Season ' + seasonNum;

                // Scroll to episodes
                episodeContainer.scrollIntoView({ behavior: 'smooth', block: 'start' });
            }
        });
    });

    // Hover effects via JS for more complex interactions if needed
});
