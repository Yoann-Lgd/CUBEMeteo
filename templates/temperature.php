<?php

/*CONNECTION AVEC LA BDD MYSQL*/

require('connect.php'); /*Fichier contenant la fonction connect_to() qui permet de faire la connection avec la BDD*/

$BDD = connect_to('cube_meteo');

/*
$cursor = $BDD->query('SELECT * FROM temperature');
$dataToReturn = $cursor->fetchAll();

print_r($dataToReturn);
*/
?>


<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../CSS/styles.css">
        <title>Météo</title>
    </head>
        <body>
            <header>
                <h1>Quelle température:</h1>
                <p>Jettez un oeil à la température sur les dernières heures.</p>
            </header>
            <div class="graph">
                <div class="lundi">LU.</div>
                <div class="mardi">MA.</div>
                <div class="mercredi">ME.</div>
                <div class="jeudi">JE.</div>
                <div class="vendredi">VE.</div>
                <div class="samedi">SA.</div>
                <div class="dimanche">DI.</div>
            </div>
            <p>La température moyenne sur les 5 derniers jours était de X.</p>
            
            <div class="accueil">
                <a href="index.html"><img src="../images/maison 1.svg"></a>
            </div>
        </body>
</html>