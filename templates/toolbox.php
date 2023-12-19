<?php

//*******************************************************************************************//
// Module contenant les fonctions suivantes : averageFromArray / fiveDayBefore / averageTemp //
//*******************************************************************************************//

function averageFromArray($Array)
{
    // retourne la moyenne d'un tableau passé en paramètre
    $sum = array_sum($Array);
    $averageData = $sum / count($Array);
    return $averageData;
}

//----------------------------------------------------------------------------------------------------------------------------------------//

function fiveDayBefore()
{
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
    $actualDay = $yearAndMonth . "-" . $day;
    $dayFour = $yearAndMonth . "-" . $minusOne;
    $dayThree = $yearAndMonth . "-" . $minusTwo;
    $dayTwo = $yearAndMonth . "-" . $minusThree;
    $dayOne = $yearAndMonth . "-" . $minusFour;

    //On les ajoutent à une liste que l'on va return
    $arrayToReturn = [];
    $arrayToReturn[] = $actualDay;
    $arrayToReturn[] = $dayFour;
    $arrayToReturn[] = $dayThree;
    $arrayToReturn[] = $dayTwo;
    $arrayToReturn[] = $dayOne;

    return $arrayToReturn;
}

//----------------------------------------------------------------------------------------------------------------------------------------//

function averageTemp($BDD, $Table,$day)
{
    $fiveDay = fiveDayBefore();
    $day = $fiveDay[0][0];

    $cursor = $BDD->query("SELECT Temperature FROM ".$Table." WHERE Date LIKE '%" . $day . "%'");
    $data = $cursor->fetchAll(PDO::FETCH_DEFAULT);
    $length = count($data);
    $today_sum = [];
    for ($i = 1; $i < $length; $i++) {
        $today_sum[] = $data[$i][0];

    }

    return averageFromArray($today_sum);
}
?>