<?php

/*CONNECTION AVEC LA BDD MYSQL*/

require('connect.php'); /*Fichier contenant la fonction connect_to() qui permet de faire la connection avec la BDD*/

$BDD = connect_to('cube_meteo');


$cursor = $BDD->query('SELECT * FROM temperature');
$dataToReturn = $cursor->fetchAll(PDO::FETCH_ASSOC);

echo date("Y-m-d h:i:s")."              ";


function averageTemp($BDD,$Table){

    /* On récupère le jour actuel et on lui retire 5 de 1 en 1 en stockant dans des variables pour récupérer les 5 derniers jours */

    $day = date("d");
    $minusOne = $day-1;
    $minusTwo = $minusOne-1;
    $minusThree = $minusTwo-1;
    $minusFour = $minusThree-1;

    //docTest
    /*echo $day . "/".$minusOne."/".$minusTwo."/".$minusThree."/".$minusFour;*/
    //
    //Définir les dates à comparer:
    $monthAndYear = date("m/Y");
    $actualDay = $day."/".$monthAndYear;
    $dayFour = $minusOne."/".$monthAndYear;
    $dayThree = $minusTwo."/".$monthAndYear;
    $dayTwo = $minusThree."/".$monthAndYear;
    $dayOne = $minusFour."/".$monthAndYear;

    echo $actualDay . "   /   " .$dayFour . "   /   " .$dayThree . "   /   " .$dayTwo . "   /   " .$dayOne;

}

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