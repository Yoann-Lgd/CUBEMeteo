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


// Endpoint pour créer une sonde
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['nom'])) {
    $nom = $_POST['nom'];

    $result = insertSonde($nom);

    if ($result) {
        echo 'Sonde créée avec succès.';
    } else {
        echo 'Erreur lors de la création de la sonde.';
    }
} else {
    http_response_code(400);
    echo 'Requête invalide.';
}

// Exemple d'utilisation
$idSonde = 1; // ID de la sonde
$dateDebut = '2023-12-16 00:00:00'; // Date de début
$dateFin = '2023-12-20 23:59:59'; // Date de fin

$releves = getRelevesBetweenDates($idSonde, $dateDebut, $dateFin);

// Traiter les relevés récupérés
foreach ($releves as $releve) {
    $date = $releve['Date'];
    $temperature = $releve['Temperature'];
    $humidite = $releve['Humidite'];

    echo "Date: $date, Temperature: $temperature, Humidite: $humidite<br>";
}


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