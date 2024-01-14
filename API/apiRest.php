<?php

header("Content-Type: application/json");
// Autoriser l'accès depuis n'importe quelle origine
header("Access-Control-Allow-Origin: *");
// Autoriser certaines méthodes HTTP
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
// Autoriser certains en-têtes dans la requête
header("Access-Control-Allow-Headers: Content-Type");

require('RelevesDAO.php');
require('SondeDAO.php');
require('DbConnect.php');

//Récupération de la méthode HTTP
$method = $_SERVER['REQUEST_METHOD'];

// Endpoints existants 
// Traitement de la demande en fonction de la méthode
switch ($method) {
    case 'GET':
        if (isset($_GET['resource'])) {
            $resource = $_GET['resource'];
            switch ($resource) {
                // http://api.localhost:9530/apirest.php?resource=sonde&idSonde=:id
                case 'sonde':
                    if (!empty($_GET['idSonde'])) {
                        $result = getSondeById($_GET['idSonde']);
                    } else {
                        $result = ['message' => 'Paramètres manquants'];
                        http_response_code(400);
                    }
                    break;
                // http://api.localhost:9530/apirest.php?resource=sondes
                case 'sondes':
                    $result = getAllSonde();
                    break;
                case 'releves':
                    // http://api.localhost:9530/apirest.php?resource=releves&idSonde=:idSonde
                    if (!empty($_GET['idSonde'])) {
                        $result = getRelevesBySonde($_GET['idSonde']);
                    } else {
                        $result = ['message' => 'Paramètres manquants'];
                        http_response_code(400);
                    }
                    break;
                case 'releves_periode':
                    //http://api.localhost:9530/apirest.php?resource=releves_periode&idSonde=:idSonde&date_debut=:YYYY-MM-DD&date_fin=:YYYY-MM-DD
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

    // Endpoints qui gèrent la création des sondes et de ses relevés
    case 'POST':
        $url = $_SERVER['REQUEST_URI'];
        $urlParts = explode('?', $url);
        $resource = end($urlParts); // Récupérer la dernière partie de l'URL

        switch ($resource) {
            // http://localhost:9530/apirest.php?sonde
            case 'sonde':
                $data = json_decode(file_get_contents("php://input"), true);
                $result = insertSonde($data['nom']);
                http_response_code(200);
                break;
            
            // http://localhost:9530/apirest.php?releves
            case 'releves':
                $data = json_decode(file_get_contents("php://input"), true);
                $result = insertReleves($data['date'], $data['temperature'], $data['humidite'], $data['ID_Sonde']);
                http_response_code(200);
                break;

            // Message d'erreur si la ressource dans l'URL n'est pas correcte
            default:
                $result = ['message' => 'Ressource non trouvée dans l\'URL'];
                http_response_code(404);
                break;
        }
        break;
    
    // Endpoints qui gèrent la modification des sondes
    case 'PUT';
    $url = $_SERVER['REQUEST_URI'];
    $urlParts = explode('?', $url);
    $resource = end($urlParts); 
    switch ($resource) {
        // http://localhost:9530/apirest.php?sonde
        case 'sonde':
            $data = json_decode(file_get_contents("php://input"), true);
            $result = updateSonde($data['idSonde'], $data['nom']);
            break;
        // Message d'erreur si la ressource dans l'URL n'est pas correcte
        default:
            $result = ['message' => 'Ressource non trouvée dans l\'URL'];
            http_response_code(404);
            break;
    }

        // Endpoints qui gèrent la modification des sondes
        case 'DELETE';
        $url = $_SERVER['REQUEST_URI'];
        $urlParts = explode('?', $url);
        $resource = end($urlParts); 
        switch ($resource) {
            // http://localhost:9530/apirest.php?sonde
            case 'sonde':
                $data = json_decode(file_get_contents("php://input"), true);
                $result = deleteSondeById($data['idSonde']);
                break;
            // Message d'erreur si la ressource dans l'URL n'est pas correcte
            default:
                $result = ['message' => 'Ressource non trouvée dans l\'URL'];
                http_response_code(404);
                break;
        }
    break;
}

echo json_encode($result);