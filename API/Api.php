<?php

include_once '../BDD/SondeDAO.php';
include_once '../BDD/RelevesDAO.php';

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

//     // Utiliser la fonction insertSonde de la classe SondeDAO
//     $result = insertSonde($nom);

//     // Répondre en fonction du résultat
//     if ($result) {
//         echo 'Sonde créée avec succès.';
//     } else {
//         echo 'Erreur lors de la création de la sonde.';
//     }
// } else {
//     http_response_code(400);
//     echo 'Requête invalide.';
// }


// for($i=1;$i<=30;$i++){
//     $jsonData = generateRaspberryData();
//     if ($jsonData !== null) {
//         $data = json_decode($jsonData, true);

//         if ($data !== null) {
//             $deviceId = $data['id'];
//             $deviceName = $data['deviceName'];
//             $temperature = $data['temperature'];
//             $dateRelevee = $data['date'];
//             $humidite = $data['humidity'];
//         } else {
//             echo "Erreur lors du décodage des données JSON.";
//         }
//     } else {
//         echo "Erreur provenant du scrypt Raspberry";
//     }
//     insertReleves($dateRelevee, $temperature, $humidite, 1);
// }

?>