<?php
# Inicializamos la constante, que almacena la URL de la API
const API_URL = "https://whenisthenextmcufilm.com/api";

# Inicializar nueva sesión de CURL; ch = curl Handle
$ch = curl_init(API_URL);

/* Indicamos que queremos recibir el resultado de la petición y que no se muestre por pantalla, que normalmente php lo hace
        , basicamente realiza un echo 
    */

curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
// Ejecutamos la petición y la guardamos 
$result = curl_exec($ch);

/*
    Para solo obtener una cosa mediante el get de una API podriamos hacer uso de 
    file_get_contents, quedando así $result = file_get_contents(API_URL);
    */


// Aqui hay que tener en cuenta de que lo almacena en json.Y se usa el decode para guardarlo en un array asociativo, asi es mas facil accerder a la información
$data = json_decode($result, true);

//Hay que cerrarlo para evitar problemas con PHP
curl_close($ch);
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Proxima pelicula de marvel</title>

    <!-- Centered viewport -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@picocss/pico@2/css/pico.classless.min.css" />

</head>

<body>

<pre style="font-size: 40; overflow: scroll; height: 300px">
    <?php var_dump($data); ?>
    </pre>

    <div>

        <img src="<?= $data["poster_url"]; ?>" width="300" alt='Poster de <?= $data["title"]; ?>'>

        <hgroup>
            <h2><?= $data["title"]; ?> se estrena en <?= $data["days_until"]; ?> días </h2>
            <p>Y la fecha de estreno es el <?= $data["release_date"]; ?> </p>
            <p>La siguiente pelicula es: <?= $data["following_production"]["title"]; ?> </p>
        </hgroup>

    </div>

</body>

</html>




<style>
    :root {
        color-scheme: light dark;
    }

    body {
        display: grid;
        place-content: center;
    }

    div {
        display: flex;
        justify-content: center;
        text-align: center;
    }

    hgroup {
        display: flex;
        flex-direction: column;
        justify-content: center;
        text-align: center;
    }

    img {
        margin: 0 auto;
    }
</style>