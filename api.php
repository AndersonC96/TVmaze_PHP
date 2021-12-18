<?php
    if(isset($_GET['category'])){
        $array = creacion();// Crie a array com os dados da API
        $category = $_GET['category'];// Pegue o valor da categoria
        $series = getValores($array);// Pegue os valores da categoria
        $series = $series[ucwords($category)];
    }
    function creacion(){// Crie a array com os dados da API
        $url = "http://api.tvmaze.com/shows";// URL da API
        $array = json_decode(file_get_contents($url), TRUE);// Crie a array com os dados da API
        return $array;// Retorne a array com os dados da API
    }
    function getValores($array){// Pegue os valores da categoria
        $series = array();// Crie a array com os dados da API
        for($i = 0; $i < count($array); $i++){// Para cada item da array
            /*$categoria = $array[$i]['type'];// Pegue o valor da categoria
            if(!isset($series[$categoria])){// Se a categoria não existir
                $series[$categoria] = array();// Crie a categoria
            }
            array_push($series[$categoria], $array[$i]);// Adicione o item na categoria*/
            for($j = 0; $j < count($array[$i]['genres']); $j++){// Para cada item da categoria
                /*$categoria = $array[$i]['genres'][$j];// Pegue o valor da categoria
                if(!isset($series[$categoria])){// Se a categoria não existir
                    $series[$categoria] = array();// Crie a categoria
                }
                array_push($series[$categoria], $array[$i]);// Adicione o item na categoria*/
                $image = str_replace('http', 'http', $array[$i]['image']['medium']);// Pegue a imagem
                $serie = array($array[$i]['name'], $array[$i]['rating']['average'], $image, $array[$i]['id']);// Crie a array com os dados da API
                $series[$array[$i]['genres'][$j]][] = $serie;// Adicione o item na categoria
            }
        }
        return $series;// Retorne a array com os dados da API
    }
    function getValoresIndividual($id){// Pegue os valores da categoria
        require_once 'serieIndividual.php';// Importe o arquivo
        require_once 'cast.php';// Importe o arquivo
        require_once 'episodes.php';// Importe o arquivo
        $url = "http://api.tvmaze.com/shows/" . $id . '?embed=cast';// Crie a url
        $array = json_decode(file_get_contents($url), TRUE);// Crie a array com os dados da API
        $serieTotal = array();
        if(count($array) > 0){// Se a array não for vazia
            /*$serieTotal['name'] = $array['name'];// Pegue o nome
            $serieTotal['rating'] = $array['rating']['average'];// Pegue a nota
            $serieTotal['image'] = str_replace('http', 'https', $array['image']['medium']);// Pegue a imagem
            $serieTotal['id'] = $array['id'];// Pegue o id
            $serieTotal['summary'] = $array['summary'];// Pegue o resumo
            $serieTotal['cast'] = getCast($array['_embedded']['cast']);// Pegue o cast*/
            $image = str_replace('http', 'https', $array['image']['original']);// Pegue a imagem
            $serie = new Serie($array['name'], $array['rating']['average'], $array['image']['original'], $array['id']);// Crie a array com os dados da API
            $serie->setSummary($array['summary']);// Pegue o resumo
            $serie->setLanguage($array['language']);// Pegue o idioma
            $serie->setType($array['type']);// Pegue o tipo
            $serie->setGenres($array['genres']);// Pegue o genero
            $serie->setStatus($array['status']);// Pegue o status
            $serie->setSchedule($array['schedule']['days'][0] . ' at ' . $array['schedule']['time']);// Pegue o horario
            $serie->setRuntime($array['runtime']);// Pegue o tempo de duração
            $serie->setPremiered($array['premiered']);// Pegue a data de lançamento
            $serie->setNetwork($array['network']['name']);// Pegue a rede
            $serie->setWebChannel($array['webChannel']['name']);// Pegue a rede web
            $serie->setEnded($array['ended']);// Pegue a data de encerramento
            $serie->setAverageRuntime($array['averageRuntime']);// Pegue o tempo de duração médio
            $serie->setOfficialSite($array['officialSite']);// Pegue o site oficial
            $serie->setRating($array['rating']['average']);// Pegue o site oficial
            for($i = 0; $i < count($array['_embedded']['cast']); $i++){// Para cada item da array
                /*$serie->addCast(new Cast($array['_embedded']['cast'][$i]['person']['name'], $array['_embedded']['cast'][$i]['character']['name']));// Adicione o item na categoria*/
                $imageCast = $array['_embedded']['cast'][$i]['person']['image']['medium'];// Pegue a imagem
                $castIndi = new Cast($array['_embedded']['cast'][$i]['person']['name'], $array['_embedded']['cast'][$i]['character']['name'], $imageCast);// Crie a array com os dados da API
                $cast[] = $castIndi;// Adicione o item na categoria
            }
            //for($i = 0; $i < count($array['_embedded']['episodes']); $i++){// Para cada item da array
                /*$serie->addEpisodes(new Episodes($array['_embedded']['episodes'][$i]['name'], $array['_embedded']['episodes'][$i]['season'], $array['_embedded']['episodes'][$i]['number'], $array['_embedded']['episodes'][$i]['airdate'], $array['_embedded']['episodes'][$i]['summary']));// Adicione o item na categoria*/
                //$imageEpisodes = $array(['_embedded']['episodes'][$i]['image']['medium']);// Pegue a imagem
            //}
            $serieTotal[] = $serie;// Adicione o item na categoria
            $serieTotal[] = $cast;
        }
        return $serieTotal;// Retorne a array com os dados da API
    }