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

//Récupération de la méthode HTTP
$method = $_SERVER['REQUEST_METHOD'];

// Traitement de la demande en fonction de la méthode
switch ($method) {
    case 'GET':
        if (isset($_GET['resource'])) {
            $resource = $_GET['resource'];
            switch ($resource) {
                case 'sondes':
                    $result = getAllSonde();
                    break;
                case 'releves':
                    if (!empty($_GET['idSonde'])) {
                        $result = getRelevesBySonde($_GET['idSonde']);
                    } else {
                        $result = ['message' => 'Paramètres manquants'];
                        http_response_code(400);
                    }
                    break;
                case 'releves_periode':
                    if (!empty($_GET['idSonde']) && !empty($_GET['date_debut']) && !empty($_GET['date_fin'])) {
                        // On récupère les valeurs passées dans l'url
                        $idSonde = $_GET['idSonde'];
                        $dateDebut = $_GET['date_debut'];
                        $dateFin = $_GET['date_fin'];

                        $result = getRelevesBetweenDates($idSonde, $dateDebut, $dateFin);
                    } else {
                        $result = ['message' => 'Paramètres manquants'];
                        http_response_code(400);
                    }
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
