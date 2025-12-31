<!DOCTYPE html>
<html lang="en" data-bs-theme="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= isset($title) ? $title . ' - TVMaze' : 'TVMaze Streaming' ?></title>
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;600;700&display=swap" rel="stylesheet">
    
    <!-- Bootstrap 5.3 & Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Custom CSS -->
    <link rel="stylesheet" href="/css/style.css">
</head>
<body>

    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg fixed-top navbar-glass">
        <div class="container-fluid px-4">
            <a class="navbar-brand fw-bold text-gradient" href="/">
                <i class="fa-solid fa-tv me-2"></i>TVMAZE
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item"><a class="nav-link active" href="/">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="/show?q=movie">Movies</a></li>
                    <li class="nav-item"><a class="nav-link" href="/">Series</a></li>
                </ul>
                <form class="d-flex position-relative search-form" action="/show" method="GET">
                    <input class="form-control me-2 rounded-pill search-input" type="search" name="q" placeholder="Search..." aria-label="Search">
                    <button class="btn btn-search position-absolute end-0 top-0 me-3 mt-1" type="submit"><i class="fa fa-search text-muted"></i></button>
                </form>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main>
