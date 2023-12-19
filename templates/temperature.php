<?php

/*CONNECTION AVEC LA BDD MYSQL*/

require('connect.php'); /*Fichier contenant la fonction connect_to() qui permet de faire la connection avec la BDD*/

$BDD = connect_to('cube_meteo');

// $h = date("h") + 1;
// echo date("Y-m-d ".$h.":i:s") . "              ";


function averageFromArray($Array){
    // retourne la moyenne d'un tableau passé en paramètre
    $sum = array_sum($Array);
    $averageData = $sum / count($Array);
    return $averageData;
}

function fiveDayBefore(){
    /* On récupère le jour actuel et on lui retire 5 de 1 en 1 en stockant dans des variables pour récupérer les 5 derniers jours */

    $day = date("d");
    $minusOne = $day - 1;
    $minusTwo = $minusOne - 1;
    $minusThree = $minusTwo - 1;
    $minusFour = $minusThree - 1;

    //docTest
    /*echo $day . "/".$minusOne."/".$minusTwo."/".$minusThree."/".$minusFour;*/
    //


    //Définir les dates à comparer:
    $yearAndMonth = date("Y-m");
    $actualDay =$yearAndMonth."-" . $day;
    $dayFour = $yearAndMonth."-".$minusOne  ;
    $dayThree = $yearAndMonth."-".$minusTwo  ;
    $dayTwo = $yearAndMonth."-".$minusThree ;
    $dayOne = $yearAndMonth."-".$minusFour ;

    //On les ajoutent à une liste que l'on va return
    $arrayToReturn = [];
    $arrayToReturn[] = $actualDay;
    $arrayToReturn[] = $dayFour;
    $arrayToReturn[] = $dayThree;
    $arrayToReturn[] = $dayTwo;
    $arrayToReturn[] = $dayOne;

    return $arrayToReturn;
}

function averageTemp($BDD, $Table)
{
    $fiveDay = fiveDayBefore();
    $actualDay = $fiveDay[0][0];

    $cursor = $BDD->query("SELECT Temperature FROM releves WHERE Date LIKE '%".$actualDay."%'");
    $data = $cursor->fetchAll(PDO::FETCH_DEFAULT);
    $length= count($data);
    $today_sum = [];
    for($i = 1;$i<$length;$i++){
        $today_sum[] = $data[$i][0];
        
    }

    echo averageFromArray($today_sum);
}

averageTemp($BDD,'releves');


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

            <table class="charts-css bar data-spacing-5">
                <caption>
                    Température
                </caption>

                <tbody>
                    <tr>
                        <th scope="bar">Test date</th>
                        <td style="--size: calc(40 / 100)"></td>
                    </tr>
                    <tr>
                        <th scope="bar"></th>
                        <td style="--size: calc(60 / 100)"></td>
                    </tr>
                    <tr>
                        <th scope="bar"></th>

                        <td style="--size: calc(75 / 100)"></td>
                    </tr>
                    <tr>
                        <th scope="bar"></th>

                        <td style="--size: calc(90 / 100)"></td>
                    </tr>
                    <tr>
                        <th scope="bar"></th>

                        <td style="--size: calc(100 / 100)"></td>
                    </tr>
                </tbody>
            </table>

            <p>La température moyenne sur les 5 derniers jours était de&nbspX.</p>
            <img src="../images/rire.svg" />
        </div>
    </div>

    <div class="accueil">
        <a href="index.html"><img src="../images/maison.svg" /></a>
    </div>
</body>

</html>