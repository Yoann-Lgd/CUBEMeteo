<?php

// header("Content-Type: application/json");

require('RelevesDAO.php');
require('SondeDAO.php');
// require('../Sonde/script.php');
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

/*CONNECTION AVEC LA BDD MYSQL*/
// $db == database

//Température

    if($_GET['combo1']!=""){ //on change les valeur de debut et fin si l'utilisateur les a sélectionnées
    if($_GET['combo2']!=""){ 
        $date_debut = $_GET['combo1'];
        $date_fin = $_GET['combo2'];
        $array_releves = getRelevesBetweenDates("1", $date_debut, $date_fin);
    }
}
else{

    $date_debut = date("Y-m-d");
    $date_fin = date("Y-m-d");;
    // $todayTemp = dayTemp($db,$yesterday);
    $array_releves = [];
    // for($i =0;$i<$todayTemp;$i++){
    //     $array_releves[] = 
    //         [
    //         "Temperature" => $todayTemp[0][$i],
    //         "Date" => date("Y-m-d"),
    //         ];
    // }


}
if($_GET['combo1']!="" And $_GET['combo2']==""){
    $date_debut = date("Y-m-d");
    $date_fin = date("Y-m-d");
    $cursor  = $db->query("SELECT Temperature FROM releves WHERE Date ='".$date_debut."'");
    $data = $cursor->fetchAll(PDO::FETCH_ASSOC);
    
    $array_releves = $data;
    return $array_releves;
}



//Humidité

    if($_GET['combo1']!=""){ //on change les valeur de debut et fin si l'utilisateur les a sélectionnées
    if($_GET['combo2']!=""){ 
        $date_debut2 = $_GET['combo1'];
        $date_fin2 = $_GET['combo2'];
        $array_releves2 = getRelevesBetweenDates("1", $date_debut2, $date_fin2);
    }
}
else{

    $date_debut2 = date("Y-m-d");
    $date_fin2 = date("Y-m-d");
    // $todayTemp = dayTemp($db,$yesterday);
    $array_releves2 = [];
    // for($i =0;$i<$todayTemp;$i++){
    //     $array_releves[] = 
    //         [
    //         "Temperature" => $todayTemp[0][$i],
    //         "Date" => date("Y-m-d"),
    //         ];
    // }


}
if($_GET['combo1']!="" And $_GET['combo2']==""){
    $date_debut2 = date("Y-m-d");
    $date_fin2 = date("Y-m-d");
    $cursor  = $db->query("SELECT Humidite FROM releves WHERE Date ='".$date_debut2."'");
    $data = $cursor->fetchAll(PDO::FETCH_ASSOC);
    
    $array_releves2 = $data;
}
return $array_releves2;


// feedRelevesDb();

