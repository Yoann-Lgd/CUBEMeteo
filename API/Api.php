<?php

include_once '../BDD/SondeDAO.php';
include_once '../BDD/RelevesDAO.php';
include_once '../scrypt/scrypt.php';


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


//Boucle permettant de créer/insérer un jeu de données sur les 5 derniers jours
function feedRelevesDb(){
    $jsonData = generateDataForFiveDays();

$dataList = json_decode($jsonData, true);

if ($dataList !== null) {
    foreach ($dataList as $data) {
        $temperature = $data['temperature'];
        $date = $data['date'];
        $humidite = $data['humidite'];
        insertReleves($date, $temperature, $humidite, 1);
    }
}
}


feedRelevesDb();