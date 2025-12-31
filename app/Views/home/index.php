<?php require_once '../app/Views/layouts/header.php'; ?>

<div class="container-fluid px-0">
    <!-- Jumbotron / Hero for Featured Show (Static for now, could be dynamic) -->
    <div class="hero-section d-flex align-items-end mb-5" style="background-image: url('https://static.tvmaze.com/uploads/images/original_untouched/406/1015647.jpg');">
        <div class="hero-overlay">
            <div class="container">
                <h1 class="display-3 fw-bold text-white mb-2">House of the Dragon</h1>
                <p class="lead text-light w-50 d-none d-md-block">The story of the House Targaryen. 200 years before the events of Game of Thrones, the House Targaryen rules on the Seven Kingdoms.</p>
                <a href="/show?id=44778" class="btn btn-lg btn-primary rounded-pill px-5 mt-3 shadow-lg border-0" style="background: var(--primary-color);">
                    <i class="fa fa-play me-2"></i> Watch Details
                </a>
            </div>
        </div>
    </div>

    <div class="container pb-5">
        <h2 class="mb-4 border-start border-4 border-primary ps-3 text-white"><?= $title ?></h2>
        
        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 row-cols-xl-6 g-4">
            <?php foreach ($shows as $item): 
                // Handle different array structures (search results vs direct show list)
                $show = isset($item['show']) ? $item['show'] : $item;
                $image = $show['image']['medium'] ?? 'https://via.placeholder.com/210x295?text=No+Image';
                $rating = $show['rating']['average'] ?? 'N/A';
            ?>
                <div class="col">
                    <a href="/show?id=<?= $show['id'] ?>" class="text-decoration-none">
                        <div class="show-card h-100">
                            <div class="card-img-wrapper">
                                <img src="<?= $image ?>" alt="<?= htmlspecialchars($show['name']) ?>" loading="lazy">
                                <div class="card-rating">
                                    <i class="fa fa-star me-1"></i><?= $rating ?>
                                </div>
                            </div>
                            <div class="card-info">
                                <h3 class="card-title text-white"><?= htmlspecialchars($show['name']) ?></h3>
                                <div class="card-genres mt-1">
                                    <?= implode(', ', array_slice($show['genres'] ?? [], 0, 2)) ?>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>

<?php require_once '../app/Views/layouts/footer.php'; ?>
