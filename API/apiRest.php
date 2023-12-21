<?php

header("Content-Type: application/json");

require('RelevesDAO.php');
require('SondeDAO.php');
// require('../scrypt/scrypt.php');
require('toolbox.php');


// Récupérer la méthode HTTP
$method = $_SERVER['REQUEST_METHOD'];

// Traiter la demande en fonction de la méthode
switch ($method) {  
    case 'GET':
        if (isset($_GET['resource'])) {
            $resource = $_GET['resource'];
            switch ($resource) {
                case 'sondes':
                    $result = getAllSonde();
                    break;
                case 'releves':
                    $result = getRelevesBySonde(1);
                    break;
                default:
                    $result = ['message' => 'Ressource non trouvée'];
                    http_response_code(404);
                    break;
            }
        } else {
            $result = ['message' => 'Ressource non spécifiée Get'];
            http_response_code(400);
        }
        break;

        case 'POST':
            $data = json_decode(file_get_contents("php://input"), true);
            if (isset($data['resource'])) {
                $resource = $data['resource'];
                switch ($resource) {
                    case 'sonde':
                        $result = insertSonde($data['nom']);
                        var_dump($data['nom']);
                        break;
                    case 'releves':
                        $result = insertReleves($data['date'], $data['temperature'], $data['humidite'], $data['idSonde']);
                        break;
                    default:
                        $result = ['message' => 'Ressource non trouvée'];
                        http_response_code(404);
                        break;
                }
            } else {
                $result = ['message' => 'Ressource non spécifiée dans post'];
                http_response_code(400);
            }
            break;

        default:
            $result = ['message' => 'Méthode non autorisée'];
            http_response_code(405);
            break;
}


echo json_encode($result);


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

