<?php
    if(isset($_GET['id'])){// se o id existe
        /*$id = $_GET['id'];
        $serie = new Serie($id);
        $serie->getInfo();
        $serie->getEpisodes();
        $serie->getCast();
        $serie->getSimilar();
        $serie->getImages();
        $serie->getVideos();
        $serie->getComments();
        $serie->getRatings();
        $serie->getReviews();
        $serie->getRecommendations();
        $serie->getExternalIds();
        $serie->getCredits();
        $serie->getChanges();
        $serie->getContentRatings();
        $serie->getExternalIds();
        $serie->getVideos();
        $serie->getCredits();
        $serie->getChanges();
        $serie->getContentRatings();
        $serie->getExternalIds();
        $serie->getVideos();
        $serie->getCredits();
        $serie->getChanges();
        $serie->getContentRatings();
        $serie->getExternalIds();
        $serie->getVideos();
        $serie->getCredits();
        $serie->getChanges();
        $serie->getContentRatings();
        $serie->getExternalIds();
        $serie->getVideos();
        $serie->getCredits();
        $serie->getChanges();
        $serie->getContentRatings();
        $serie->getExternalIds();
        $serie->getVideos();
        $serie->getCredits();
        $serie->getChanges();
        $serie->getContentRatings();
        $serie->getExternalIds();
        $serie->getVideos();
        $serie->getCredits();
        $serie->getChanges();
        $serie->getContentRatings();
        $serie->getExternalIds();
        $serie->getVideos();*/
        $id = $_GET['id'];// pega o id da url
        require_once 'api.php';// chama o arquivo api.php
        $serieTotal = getValoresIndividual($id);// pega os dados da api
        $serie = $serieTotal[0];// pega o primeiro valor do array
        $casting = $serieTotal[1];// pega o segundo valor do array
    }else{
        header('Location: /');// redireciona para a pagina inicial
        die();// para o script
    }
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title><?= $serie->getTitle() ?></title>
        <link href="https://fonts.googleapis.com/css?family=Barlow:300|Fira+Sans:500&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="css/stylesPageSerie.css">
        <link rel="shortcut icon" href="./images/favicon.png"/>
    </head>
    <body>
        <header id="header">
            <img id="btnBack" src="images/back.png" alt="Back">
            <h1><?= $serie->getTitle() ?></h1>
        </header>
        <main id="main">
            <div class="contenedor">
                <div class="principal">
                    <img src="<?= $serie->getImage() ?>" alt="Imagen Serie <?= $serie->getTitle() ?>">
                    <div class="informacionPrincipal">
                        <div class="sinopsis">
                            <h2>SINOPSE</h2>
                            <h3><?= $serie->getSummary() ?></h3>
                        </div>
                        <hr>
                        <div class="informacionSerie">
                            <h2><strong>Tipo: </strong><?= $serie->getType() ?></h2>
                            <h2><strong>Gêneros: </strong>
                                <?php
                                    for($i = 0; $i < count($serie->getGenres()); $i++) :// para cada genero
                                        /*if($i == count($serie->getGenres()) - 1) :// se for o ultimo genero
                                            echo $serie->getGenres()[$i];// imprime o genero
                                        else :// se nao for o ultimo genero
                                            echo $serie->getGenres()[$i] . ', ';// imprime o genero e a virgula
                                        endif;*/
                                ?>
                                <a href="/?category=<?= $serie->getGenres()[$i] ?>">
                                    <?= $serie->getGenres()[$i] ?>
                                </a>
                                <?php endfor; ?>
                            </h2>
                            <h2><strong>Língua: </strong><?= $serie->getLanguage() ?></h2>
                            <h2><strong>Status: </strong><?= $serie->getStatus() ?></h2>
                            <h2><strong>Horário: </strong><?= $serie->getSchedule() ?></h2>
                            <h2><strong>Duração: </strong><?= $serie->getRuntime() ?> minutes | <strong>Tempo médio de duração: </strong><?= $serie->getAverageRuntime() ?> minutes</h2>
                            <h2><strong>Estreia: </strong><?= date('d/m/Y', strtotime($serie->getPremiered())) ?> | <strong>Finalizada: </strong><?= date('d/m/Y', strtotime($serie->getEnded())) ?></h2>
                            <h2><strong>Network: </strong><?= $serie->getNetwork() ?> | <strong>Streaming: </strong><?= $serie->getWebChannel() ?></h2>
                            <h2 href="<?= $serie->getOfficialSite() ?>"><strong>Site: </strong><?= $serie->getOfficialSite() ?></h2>
                            <h2><strong>Avaliação: </strong><?= $serie->getRating() ?>/10</h2>
                        </div>
                    </div>
                </div>
                <hr>
                <h2 id="cast">Cast '<?= $serie->getTitle() ?>'</h2>
                <div class="cast">
                    <?php
                        for($i = 0; $i < count($casting); $i++) :// para cada personagem
                    ?>
                    <div class="cardCast">
                        <img src="<?= $casting[$i]->getImage() ?>" alt="Serie">
                        <h3><?= $casting[$i]->getName() ?></h3>
                        <p><span>Personagem </span> <?= $casting[$i]->getAlias() ?></p>
                    </div>
                    <?php endfor; ?>
                </div>
                <!--<hr>
                <h2 id="episodes">Episodes '<?= $serie->getTitle() ?>'</h2>
                <div class="episodes">
                    <?php
                        for($i = 0; $i < count($serie->getEpisodes()); $i++) :// para cada episodio
                    ?>
                    <div class="cardEpisode">
                        <img src="<?= $serie->getEpisodes()[$i]->getImage() ?>" alt="Serie">
                        <h3><?= $serie->getEpisodes()[$i]->getName() ?></h3>
                        <p><span>Season: </span><?= $serie->getEpisodes()[$i]->getSeason() ?> | <span>Episode: </span><?= $serie->getEpisodes()[$i]->getNumber() ?></p>
                    </div>-->
                    <!--<?php endfor; ?>-->
        </main>
        <script>
            document.getElementById("btnBack").onclick = function(){// quando clicar no botao de voltar
                window.history.back();
            };
        </script>
    </body>
</html>