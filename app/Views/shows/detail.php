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
        <div class="row row-cols-2 row-cols-md-4 row-cols-lg-6 g-3" id="cast-container">
            <?php foreach($show['_embedded']['cast'] as $index => $actor): 
                $hiddenClass = $index >= 6 ? 'd-none cast-hidden' : '';
            ?>
            <div class="col <?= $hiddenClass ?>">
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
        <?php if(count($show['_embedded']['cast']) > 6): ?>
        <div class="text-center mt-3">
            <button id="btn-show-more-cast" class="btn btn-outline-primary btn-sm rounded-pill px-4">
                Show More <i class="fa fa-chevron-down ms-1"></i>
            </button>
        </div>
        <?php endif; ?>
    </section>
    <?php endif; ?>

    <!-- Crew Section -->
    <?php if(!empty($show['_embedded']['crew'])): ?>
    <section class="mb-5">
        <h3 class="mb-4 text-white"><i class="fa fa-video me-2 text-primary"></i>Crew</h3>
        <div class="row row-cols-2 row-cols-md-4 row-cols-lg-6 g-3" id="crew-container">
            <?php foreach($show['_embedded']['crew'] as $index => $member): 
                $hiddenClass = $index >= 6 ? 'd-none crew-hidden' : '';
            ?>
            <div class="col <?= $hiddenClass ?>">
                <div class="d-flex align-items-center bg-dark p-2 rounded-3 border border-secondary h-100">
                    <img src="<?= $member['person']['image']['medium'] ?? 'https://via.placeholder.com/60' ?>" class="cast-img me-3" alt="">
                    <div>
                        <div class="fw-bold small text-white"><?= $member['person']['name'] ?></div>
                        <div class="small text-muted"><?= $member['type'] ?></div>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
        <?php if(count($show['_embedded']['crew']) > 6): ?>
        <div class="text-center mt-3">
            <button id="btn-show-more-crew" class="btn btn-outline-primary btn-sm rounded-pill px-4">
                Show More <i class="fa fa-chevron-down ms-1"></i>
            </button>
        </div>
        <?php endif; ?>
    </section>
    <?php endif; ?>

    <!-- Seasons & Episodes Section -->
    <?php if(!empty($seasons) && !empty($show['_embedded']['episodes'])): 
        // Group episodes by season
        $episodesBySeason = [];
        foreach($show['_embedded']['episodes'] as $ep) {
            $episodesBySeason[$ep['season']][] = $ep;
        }
    ?>
    <section>
        <div class="d-flex align-items-center mb-4">
            <h3 class="text-white mb-0"><i class="fa fa-layer-group me-2 text-primary"></i>Seasons</h3>
        </div>

        <!-- Season Cards Grid -->
        <div class="row row-cols-2 row-cols-md-4 row-cols-lg-6 g-3 mb-5">
            <?php foreach($seasons as $season): 
                $seasonImg = $season['image']['medium'] ?? 'https://via.placeholder.com/210x295?text=S'.$season['number'];
                $isActive = $season['number'] == 1 ? 'border-primary active' : 'border-secondary';
            ?>
            <div class="col">
                <div class="card bg-dark text-white season-card-action cursor-pointer h-100 <?= $isActive ?>" 
                     data-season="<?= $season['id'] ?>" 
                     data-season-num="<?= $season['number'] ?>"
                     style="transition: all 0.2s;">
                    <img src="<?= $seasonImg ?>" class="card-img-top" alt="Season <?= $season['number'] ?>" style="height: 200px; object-fit: cover; opacity: 0.8;">
                    <div class="card-body p-2 text-center">
                        <h5 class="card-title mb-0">Season <?= $season['number'] ?></h5>
                        <small class="text-muted"><?= $season['episodeOrder'] ?? count($episodesBySeason[$season['number']] ?? []) ?> Episodes</small>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>

        <!-- Episodes List Container -->
        <div id="episodes-container" class="mt-4">
            <div class="d-flex align-items-center justify-content-between mb-4 border-bottom border-secondary pb-2">
                <h3 id="selected-season-title" class="text-white mb-0">Season 1</h3>
                <span class="badge bg-dark border border-secondary">Episodes</span>
            </div>
            
            <?php foreach($episodesBySeason as $seasonNum => $seasonEpisodes): 
                $display = $seasonNum == 1 ? '' : 'd-none';
            ?>
            <div id="season-<?= $seasonNum ?>" class="season-episodes <?= $display ?>">
                <div class="accordion" id="accordionSeason<?= $seasonNum ?>">
                    <?php foreach($seasonEpisodes as $index => $ep): 
                        $collapseId = "collapseS{$seasonNum}E{$ep['number']}";
                        $headingId = "headingS{$seasonNum}E{$ep['number']}";
                    ?>
                    <div class="episode-card">
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="<?= $headingId ?>">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#<?= $collapseId ?>" aria-expanded="false" aria-controls="<?= $collapseId ?>">
                                    <span class="episode-number">E<?= $ep['number'] ?>&nbsp;</span>
                                    <span class="flex-grow-1 fw-medium"><?= $ep['name'] ?></span>
                                    <span class="small text-muted me-3"><?= !empty($ep['airdate']) ? date('d/m/Y', strtotime($ep['airdate'])) : '' ?></span>
                                </button>
                            </h2>
                            <div id="<?= $collapseId ?>" class="accordion-collapse collapse" aria-labelledby="<?= $headingId ?>" data-bs-parent="#accordionSeason<?= $seasonNum ?>">
                                <div class="accordion-body border-top border-secondary" style="background: rgba(0,0,0,0.2);">
                                    <div class="row g-0">
                                        <?php if(isset($ep['image']['medium'])): ?>
                                        <div class="col-md-3 p-2">
                                            <img src="<?= $ep['image']['medium'] ?>" class="img-fluid rounded" alt="Episode Image">
                                        </div>
                                        <div class="col-md-9 p-3">
                                        <?php else: ?>
                                        <div class="col-12 p-3">
                                        <?php endif; ?>
                                            <h5 class="text-white mb-3"><?= $ep['name'] ?></h5>
                                            <div class="text-light-50 mb-3">
                                                <?= $ep['summary'] ?? '<p class="text-muted">No summary available.</p>' ?>
                                            </div>
                                            
                                            <div class="d-flex align-items-center text-muted small">
                                                <span class="me-3"><i class="far fa-clock me-1"></i> <?= $ep['runtime'] ?> min</span>
                                                <a href="<?= $ep['url'] ?>" target="_blank" class="text-decoration-none text-info hover-underline">TVMaze Link <i class="fa fa-external-link-alt ms-1"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </section>
    <?php endif; ?>
</div>

<?php require_once '../app/Views/layouts/footer.php'; ?>
