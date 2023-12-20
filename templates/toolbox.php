<?php

//******************************************************************************************************************************************//
// Module contenant les fonctions suivantes : averageFromArray / fiveDayBefore / averageTemp / averageHumidity / dateUnique / searchHumTemp //
//******************************************************************************************************************************************//

function averageFromArray($Array)
{
    // retourne la moyenne d'un tableau passé en paramètre
    $sum = array_sum($Array);
    if($Array != []){
        $averageData = $sum / count($Array);
        return $averageData;
    }

    return ;
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

    $cursor = $BDD->query("SELECT Temperature FROM ".$Table." WHERE Date LIKE '%" . $day . "%'");
    $data = $cursor->fetchAll(PDO::FETCH_DEFAULT);
    $length = count($data);
    $today_sum = [];
    for ($i = 1; $i < $length; $i++) {
        $today_sum[] = $data[$i][0];

    }

    $average = averageFromArray($today_sum);
    $stringValue = (string)$average;
    $dataToReturn = substr($stringValue,0,4);
    return (float)$dataToReturn;

}

//----------------------------------------------------------------------------------------------------------------------------------------//

function averageHumidity($BDD, $Table, $day){

    $cursor = $BDD->query("SELECT Humidite FROM ".$Table." WHERE Date LIKE '%" . $day . "%'");
    $data = $cursor->fetchAll(PDO::FETCH_DEFAULT);
    $length = count($data);
    $today_sum = [];
    for ($i = 1; $i < $length; $i++) {
        $today_sum[] = $data[$i][0];

    }

    $average = averageFromArray($today_sum);
    $stringValue = (string)$average;
    $dataToReturn = substr($stringValue,0,4);
    return (float)$dataToReturn;
}

//----------------------------------------------------------------------------------------------------------------------------------------//

function dateUnique($BDD,$Table){
    //retourne la liste des dates uniques d'une table dans l'ordre décroissant
    $date_array = [];
    $cursor = $BDD->query("SELECT DISTINCT LEFT($Table,10) FROM releves ORDER BY $Table DESC");
    $data_extract = $cursor->fetchAll(PDO::FETCH_ASSOC);
    for($i = 0;$i < count($data_extract);$i++){
        $date_array[] = $data_extract[$i]["LEFT(Date,10)"];
    }
    return $date_array;
}

//----------------------------------------------------------------------------------------------------------------------------------------//

function searchTemp($BDD,$date,$Table){
    $resTemp = averageTemp($BDD,'releves',$date);
    $answer = "Température moyenne du ".$date." : ".$resTemp."°C";
    return $answer;
}

//----------------------------------------------------------------------------------------------------------------------------------------//

function searchHum($BDD,$date,$Table){
    $resHum = averageHumidity($BDD,'releves',$date);
    $answer = "Humidité moyenne du ".$date." : ".$resHum."%";
    return $answer;
}

//----------------------------------------------------------------------------------------------------------------------------------------//

function picto($data){
    if($data > 20){
        echo "test";
    }
}

?>