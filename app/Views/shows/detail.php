<?php require_once '../app/Views/layouts/header.php'; 
    $bgImage = $show['image']['original'] ?? $show['image']['medium'];
?>

<div class="detail-header position-relative mb-5">
    <div style="
        position: absolute; 
        top: 0; left: 0; right: 0; bottom: 0; 
        background: url('<?= $bgImage ?>') no-repeat center top / cover; 
        opacity: 0.15; 
        z-index: -1;">
    </div>
    
    <div class="container pt-5 pb-5">
        <div class="row">
            <div class="col-md-3">
                <div class="card border-0 shadow-lg rounded-3 overflow-hidden">
                    <img src="<?= $show['image']['original'] ?? 'https://via.placeholder.com/400x600' ?>" class="img-fluid" alt="<?= $show['name'] ?>">
                </div>
            </div>
            <div class="col-md-9 pt-3">
                <div class="d-flex align-items-center mb-3">
                    <h1 class="display-4 fw-bold mb-0 me-3"><?= htmlspecialchars($show['name']) ?></h1>
                    <?php if(isset($show['rating']['average'])): ?>
                        <span class="badge bg-warning text-dark fs-5"><i class="fa fa-star me-1"></i><?= $show['rating']['average'] ?></span>
                    <?php endif; ?>
                </div>
                
                <div class="mb-4">
                    <?php foreach($show['genres'] as $genre): ?>
                        <span class="badge bg-dark border border-secondary me-1"><?= $genre ?></span>
                    <?php endforeach; ?>
                    <span class="badge bg-secondary ms-2"><?= $show['status'] ?></span>
                    <span class="text-muted ms-3"><i class="far fa-clock me-1"></i> <?= $show['runtime'] ?? 60 ?> min</span>
                </div>
                
                <h4 class="text-light border-bottom pb-2 border-secondary d-inline-block">Summary</h4>
                <div class="lead text-light-50 fs-6">
                    <?= $show['summary'] ?>
                </div>
                
                <div class="mt-4">
                    <a href="<?= $show['officialSite'] ?>" target="_blank" class="btn btn-outline-light rounded-pill"><i class="fa fa-link me-2"></i>Official Site</a>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container mb-5">
    <!-- Cast Section -->
    <?php if(!empty($show['_embedded']['cast'])): ?>
    <section class="mb-5">
        <h3 class="mb-4 text-white"><i class="fa fa-users me-2 text-primary"></i>Cast</h3>
        <div class="row row-cols-2 row-cols-md-4 row-cols-lg-6 g-3">
            <?php foreach(array_slice($show['_embedded']['cast'], 0, 12) as $actor): ?>
            <div class="col">
                <div class="d-flex align-items-center bg-dark p-2 rounded-3 border border-secondary h-100">
                    <img src="<?= $actor['person']['image']['medium'] ?? 'https://via.placeholder.com/60' ?>" class="cast-img me-3" alt="">
                    <div>
                        <div class="fw-bold small text-white"><?= $actor['person']['name'] ?></div>
                        <div class="small text-muted"><?= $actor['character']['name'] ?></div>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </section>
    <?php endif; ?>

    <!-- Episodes Section (Simple List) -->
    <?php if(!empty($show['_embedded']['episodes'])): ?>
    <section>
        <h3 class="mb-4 text-white"><i class="fa fa-list-ol me-2 text-primary"></i>Episodes</h3>
        <div class="card bg-dark border-secondary">
            <ul class="list-group list-group-flush bg-transparent">
                <?php 
                $episodes = $show['_embedded']['episodes'];
                $lastSeason = 0;
                foreach($episodes as $ep):
                    if($ep['season'] != $lastSeason) {
                        echo "<li class='list-group-item bg-secondary text-white fw-bold'>Season " . $ep['season'] . "</li>";
                        $lastSeason = $ep['season'];
                    }
                ?>
                <li class="list-group-item bg-transparent text-light border-secondary d-flex justify-content-between align-items-center">
                    <div>
                        <span class="fw-bold me-3 text-muted">S<?= $ep['season'] ?> E<?= $ep['number'] ?></span>
                        <?= $ep['name'] ?>
                    </div>
                    <span class="badge bg-dark"><?= $ep['airdate'] ?></span>
                </li>
                <?php endforeach; ?>
            </ul>
        </div>
    </section>
    <?php endif; ?>
</div>

<?php require_once '../app/Views/layouts/footer.php'; ?>
