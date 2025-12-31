
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

    // Show More Cast Interaction
    const btnShowMoreCast = document.getElementById('btn-show-more-cast');
    if (btnShowMoreCast) {
        btnShowMoreCast.addEventListener('click', function () {
            const hiddenCast = document.querySelectorAll('.cast-hidden');
            const isHidden = hiddenCast[0] ? hiddenCast[0].classList.contains('d-none') : false;

            hiddenCast.forEach(el => {
                if (isHidden) {
                    el.classList.remove('d-none');
                    el.classList.add('fade-in'); // Optional animation class
                } else {
                    el.classList.add('d-none');
                }
            });

            if (isHidden) {
                this.innerHTML = 'Show Less <i class="fa fa-chevron-up ms-1"></i>';
            } else {
                this.innerHTML = 'Show More <i class="fa fa-chevron-down ms-1"></i>';
                // Optional: scroll back to cast top
                document.getElementById('cast-container').scrollIntoView({ behavior: 'smooth', block: 'start' });
            }
        });
    }

    // Show More Crew Interaction
    const btnShowMoreCrew = document.getElementById('btn-show-more-crew');
    if (btnShowMoreCrew) {
        btnShowMoreCrew.addEventListener('click', function () {
            const hiddenCrew = document.querySelectorAll('.crew-hidden');
            const isHidden = hiddenCrew[0] ? hiddenCrew[0].classList.contains('d-none') : false;

            hiddenCrew.forEach(el => {
                if (isHidden) {
                    el.classList.remove('d-none');
                    el.classList.add('fade-in'); // Optional animation class
                } else {
                    el.classList.add('d-none');
                }
            });

            if (isHidden) {
                this.innerHTML = 'Show Less <i class="fa fa-chevron-up ms-1"></i>';
            } else {
                this.innerHTML = 'Show More <i class="fa fa-chevron-down ms-1"></i>';
                // Optional: scroll back to crew top
                document.getElementById('crew-container').scrollIntoView({ behavior: 'smooth', block: 'start' });
            }
        });
    }
});
