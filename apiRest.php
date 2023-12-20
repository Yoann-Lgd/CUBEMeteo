<?php

header("Content-Type: application/json");

require('BDD/RelevesDAO.php');
require('BDD/SondeDAO.php');


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
            $result = ['message' => 'Ressource non spécifiée'];
            http_response_code(400);
        }
        break;

        // case 'POST':
        //     $data = json_decode(file_get_contents("php://input"), true);
        //     if (isset($data['resource'])) {
        //         $resource = $data['resource'];
        //         switch ($resource) {
        //             case 'sondes':
        //                 $result = $sondeDAO->createSonde($data['nom']);
        //                 break;
        //             case 'releves':
        //                 $result = $relevesDAO->createReleves($data['date'], $data['temperature'], $data['humidite'], $data['idSonde']);
        //                 break;
        //             default:
        //                 $result = ['message' => 'Ressource non trouvée'];
        //                 http_response_code(404);
        //                 break;
        //         }
        //     } else {
        //         $result = ['message' => 'Ressource non spécifiée'];
        //         http_response_code(400);
        //     }
        //     break;

        // default:
        //     $result = ['message' => 'Méthode non autorisée'];
        //     http_response_code(405);
        //     break;
}

echo json_encode($result);
