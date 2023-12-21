<?php

//***********************************************************************//
// Module contenant les fonctions pour traiter les données sans requêtes //
//***********************************************************************//


//----------------------------------------------------------------------------------------------------------------------------------------//



function grahPoint($data){
    for($i = 0;$i<(count($data)-1);$i++){
        //pour tout les points
        $start = "0.". (int)$data[$i];
        $end = "0.". (int)$data[$i+1];
        echo('
        <tr>
        <th scope = "row"></th>
        <td style="--start:'.$start.' ; --end: '.$end.';"></td>
        </tr>
        
        ');
    }
}

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
    $heatWarning = '<img width="80" height="80" src="https://img.icons8.com/office/80/thermometer.png" alt="thermometer"/>';
    $coldWarning = '<img width="80" height="80" src="https://img.icons8.com/ultraviolet/80/thermometer.png" alt="thermometer"/>';
    if($data > 24){
        echo $heatWarning;
    }
    if($data<24){
        echo $coldWarning;
    }
}

?>