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
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="../CSS/styles.css" />
    <link rel="stylesheet" href="../CSS/charts.min.css" />
    <title>Température</title>
</head>

<body>
    <div class="mainTemperature">
        <div class="temperature">
            <h1>Quelle température:</h1>
            <p>Jettez un oeil à la température sur les dernières heures.</p>

            <table class="charts-css column">

                <caption> Température </caption>

                <tbody>
                    <tr>
                        <td style="--size: calc( 40 / 100 )"> </td>
                    </tr>
                    <tr>
                        <td style="--size: calc( 60 / 100 )"> </td>
                    </tr>
                    <tr>
                        <td style="--size: calc( 75 / 100 )"> </td>
                    </tr>
                    <tr>
                        <td style="--size: calc( 90 / 100 )"> </td>
                    </tr>
                    <tr>
                        <td style="--size: calc( 100 / 100 )"> </td>
                    </tr>
                </tbody>

            </table>

            <p>La température moyenne sur les 5 derniers jours était de&nbspX.</p>
        </div>
    </div>

    <div class="accueil">
        <a href="index.html"><img src="../images/maison.svg" /></a>
    </div>
</body>

</html>