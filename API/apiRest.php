<?php

header("Content-Type: application/json");
// Autoriser l'accès depuis n'importe quelle origine
header("Access-Control-Allow-Origin: *");
// Autoriser certaines méthodes HTTP
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
// Autoriser certains en-têtes dans la requête
header("Access-Control-Allow-Headers: Content-Type");


require('RelevesDAO.php');
require('SondeDAO.php');
require('DbConnect.php');
// require('../scrypt/scrypt.php');
// require('toolbox.php');


// Récupérer la méthode HTTP
// $method = $_SERVER['REQUEST_METHOD'];

// // Traiter la demande en fonction de la méthode
// switch ($method) {  
//     case 'GET':
//         if (isset($_GET['resource'])) {
//             $resource = $_GET['resource'];
//             switch ($resource) {
//                 case 'sondes':
//                     $result = getAllSonde();
//                     break;
//                 case 'releves':
//                     $result = getRelevesBySonde(1);
//                     break;
//                 case 'releves_periodes':
//                     $result = getRelevesBetweenDates($idSonde['idSonde'], $dateDebut['date_debut'], $dateFin['date_fin']);
//                     break;
//                 default:
//                     $result = ['message' => 'Ressource non trouvée'];
//                     http_response_code(404);
//                     break;
//             }
//         } else {
//             $result = ['message' => 'Ressource non spécifiée Get'];
//             http_response_code(400);
//         }
//         break;

//         case 'POST':
//             $data = json_decode(file_get_contents("php://input"), true);
//             if (isset($data['resource'])) {
//                 $resource = $data['resource'];
//                 switch ($resource) {
//                     case 'sonde':
//                         $result = insertSonde($data['nom']);
//                         var_dump($data['nom']);
//                         break;
//                     case 'releves':
//                         $result = insertReleves($data['date'], $data['temperature'], $data['humidite'], $data['idSonde']);
//                         break;
//                     default:
//                         $result = ['message' => 'Ressource non trouvée'];
//                         http_response_code(404);
//                         break;
//                 }
//             } else {
//                 $result = ['message' => 'Ressource non spécifiée dans post'];
//                 http_response_code(400);
//             }
//             break;

//         default:
//             $result = ['message' => 'Méthode non autorisée'];
//             http_response_code(405);
//             break;
// }
// echo json_encode($result);






// $jsonData = generateRaspberryData();

// if ($jsonData !== null) {
//     $data = json_decode($jsonData, true);

//     if ($data !== null) {
//         $deviceId = $data['id'];
//         $deviceName = $data['deviceName'];
//         $temperature = $data['temperature'];
//         $dateRelevee = $data['date'];
//         $humidite = $data['humidity'];
//     } else {
//         echo "Erreur lors du décodage des données JSON.";
//     }
// } else {
//     echo "Erreur provenant du scrypt Raspberry";
// }


// // Endpoint pour créer une sonde
// if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['nom'])) {
//     $nom = $_POST['nom'];

//     $result = insertSonde($nom);

//     if ($result) {
//         echo 'Sonde créée avec succès.';
//     } else {
//         echo 'Erreur lors de la création de la sonde.';
//     }
// } else {
//     http_response_code(400);
//     echo 'Requête invalide.';
// }


// //Boucle permettant de créer/insérer un jeu de données sur les 5 derniers jours
// function feedRelevesDb(){
//     $jsonData = generateDataForFiveDays();

// $dataList = json_decode($jsonData, true);

// if ($dataList !== null) {
//     foreach ($dataList as $data) {
//         $temperature = $data['temperature'];
//         $date = $data['date'];
//         $humidite = $data['humidite'];
//         insertReleves($date, $temperature, $humidite, 1);
//     }
// }
// }

// feedRelevesDb();



/////////////////////////////////////////////////////////////////////////////////////////////////////////

function dateUniqueReverse($BDD,$Table){
    //retourne la liste des dates uniques d'une table dans l'ordre décroissant
    $date_array = [];
    $cursor = $BDD->query("SELECT DISTINCT LEFT($Table,10) FROM releves ORDER BY $Table ASC");
    $data_extract = $cursor->fetchAll(PDO::FETCH_ASSOC);
    for($i = 0;$i < count($data_extract);$i++){
        $date_array[] = $data_extract[$i]["LEFT(Date,10)"];
    }
    return $date_array;
}

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

/////////////////////////////////////////////////////////////////////////////////////////////////////////

function extractTemp($releves){
    $length = count($releves);
    $array = [];
    foreach($releves as $object){
        $array[] = $object['Temperature'];
    }
    return $array;
}


$form_data = file_get_contents('php://input');
    $data = (array)json_decode($form_data,true);
    $date_debut = $data['date_debut'];
    $date_fin = $data['date_fin'];
    $res = getRelevesBetweenDates('1',$date_debut,$date_fin);
    $list_res = extractTemp($res);
    print_r($list_res);
    
