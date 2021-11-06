<?php
    require_once 'api.php';
    $array = creacion();// Crie a array com os dados da API
    if(isset($_GET['category'])){
    // Verifica se existe a categoria
        $category = $_GET['category'];// Pega a categoria
        //$array = filter($array, $category);// Filtra a array
    }else{// Se não existir a categoria
        $category = "";// Pega a categoria
        $categoria = "drama";
    }
?>
<!DOCTYPE html>
<html lang="pt">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>TVmaze Api</title>
        <link href="https://fonts.googleapis.com/css?family=Roboto:300,500&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="css/stylesMain.css">
        <link rel="shortcut icon" href="./images/favicon.png"/>
    </head>
    <body>
        <header id="header">
            <?php $series = getValores($array); ?>
            <a href="https://www.tvmaze.com/" target="_blank"><img src="images/logo-tvm.png" alt="Logo TvMaze"></a>
            <div id="buscar">
                <div id="buscadores">
                    <li id="buscarPrimero">Choose a category...</li>
                    <div class="contenedorCategoria visible">
                        <?php for ($i = 0; $i < count($series); $i++) : ?>
                            <li class="buscadoresGenerales"><?= array_keys($series)[$i] ?></li>
                        <?php endfor; ?>
                    </div>
                </div>
                <button id="btnSearch"><i class="fa fa-search"></i>Search</button>
            </div>
        </header>
        <main id="main">
            <div class="contenedor">
                <div class="principal">
                    <?php
                        $series = $series[ucwords($categoria)];// Pega a categoria
                        for ($i = 0; $i < (count($series) > 5 ? 5 : count($series)); $i++) :// Verifica se a quantidade de series é maior que 5
                    ?>
                    <div class="cardSerie">
                        <h3 id="estrellaTexto"><?= $series[$i][1] ?></h3>
                        <a href="serie.php?id=<?= $series[$i][3] ?>">
                            <img src="<?= $series[$i][2]?>" alt="Serie">
                        </a>
                        <div id="textoSerie">
                            <a href="serie.php?id=<?= $series[$i][3] ?>">
                                <h3><?= $series[$i][0] ?></h3>
                            </a>
                        </div>
                    </div>
                    <?php endfor; ?>
                </div>
                <?php if (count($series) > 5) : ?>
                <div id="btnAgregar">
                    <hr>
                    <img id="btnMore" src="images/more.png" alt="add more">
                </div>
                <?php endif; ?>
            </div>
        </main>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
        <script type="text/javascript">
            $(document).ready(function(){
                let category = "";
                let variableCon = 5;// Variável para controlar o número de séries
                let clickSearch = false;// Variável para controlar o click do botão de busca
                var js_array = <?php echo json_encode($series); ?>;// Crie a array com os dados da API
                $("#btnSearch").click(function(){
                    window.open("/?category=" + category, "_self");
                });
                $("#btnMore").click(function(){
                    for(let i = variableCon; i < variableCon + 5; i++){
                        if(i < js_array.length){
                            console.log(i);
                            var div = document.createElement("div");
                            div.className = "cardSerie";
                            var h3Estrella = document.createElement("h3");
                            h3Estrella.id = "estrellaTexto";
                            h3Estrella.textContent = js_array[i][1];
                            div.appendChild(h3Estrella);
                            var h3Estrella = document.createElement("h3");
                            h3Estrella.id = "estrellaTexto";
                            h3Estrella.textContent = js_array[i][1];
                            div.appendChild(h3Estrella);
                            var a = document.createElement("a");
                            a.href = "serie.php?id=" + js_array[i][3];
                            var img = document.createElement("img");
                            img.src = js_array[i][2];
                            img.alt = "Imagen Serie";
                            a.appendChild(img);
                            div.appendChild(a);
                            var div2 = document.createElement("div");
                            div2.id = "textoSerie";
                            var a2 = document.createElement("a");
                            a2.href = "serie.php?id=" + js_array[i][3];
                            var h3 = document.createElement("h3");
                            h3.textContent = js_array[i][0];
                            a2.appendChild(h3);
                            div2.appendChild(a2);
                            div.appendChild(div2);
                            $(".principal").append(div);
                        }else{
                            $("#btnAgregar").hide();
                        }
                    }
                    variableCon += 5;
                });
                $("#buscarPrimero").click(function(){
                    if(!clickSearch){
                        $(".contenedorCategoria").removeClass("visible");
                    }else{
                        $(".contenedorCategoria").addClass("visible");
                    }
                    clickSearch = !clickSearch;
                });
                $(".buscadoresGenerales").click(function(){
                    $(".contenedorCategoria").addClass("visible");
                    clickSearch = !clickSearch;
                    let newCategory = $(this).text();
                    $("#buscarPrimero").text(newCategory);
                    category = newCategory;
                });
            });
        </script>
    </body>
</html>