<?php


include_once '../scrypt/scrypt.php';
include_once '../templates/connect.php';

$jsonData = generateRaspberryData();

if ($jsonData !== null) {
    $data = json_decode($jsonData, true);

    if ($data !== null) {
        $deviceId = $data['id'];
        $deviceName = $data['deviceName'];
        $temperature = $data['temperature'];
        $dateRelevee = $data['date'];
        $humidite = $data['humidity'];
    } else {
        echo "Erreur lors du décodage des données JSON.";
    }
} else {
    echo "Erreur provenant du scrypt Raspberry";
}




// Fonction pour insérer une Sonde
function insertSonde($nom) {
    global $BDD;

    $query = "INSERT INTO Sonde (Nom) VALUES (:nom)";
    $stmt = $BDD->prepare($query);
    $stmt->bindParam(':nom', $nom);

    $result = $stmt->execute();

    if ($result) {
        echo 'Insertion de la nouvelle sonde réussie.';
    } else {
        echo 'Échec de l\'insertion.';
    }

    return $result;
}

// insertSonde($deviceName);

//Fonction pour récupérer la sonde selon son id
function getSondeById($idSonde){
    global $BDD;

    $sondeQuery = "SELECT * FROM Sonde WHERE ID = :id";
    $sondeStmt = $BDD->prepare($sondeQuery);
    $sondeStmt->bindParam(':id', $idSonde);
    $sondeStmt->execute();

    return $sondeStmt->fetch(PDO::FETCH_ASSOC);
}

// $sonde = getSondeById(1);

// Fonction pour mettre à jour la sonde selon son id
function updateSonde($id, $nom) {
    global $BDD;

    $query = "UPDATE Sonde SET nom = :nom WHERE ID = :id";
    $stmt = $BDD->prepare($query);
    $stmt->bindParam(':nom', $nom);
    $stmt->bindParam(':id', $id);

    $result = $stmt->execute();

    if ($result) {
        echo 'Mise à jour de la sonde réussie.';
    } else {
        echo 'Échec de la mise à jour.';
    }

    return $result;
}

// $sonde = updateSonde(1, "jj");

function insertReleves($date, $temperature, $humidite, $idSonde) {
    global $BDD;

    // Insérer dans la table Releves
    $queryReleves = "INSERT INTO Releves (Date, Temperature, Humidite, ID_Sonde) VALUES (:date, :temperature, :humidite, :idSonde)";
    $stmtReleves = $BDD->prepare($queryReleves);
    $stmtReleves->bindParam(':date', $date);
    $stmtReleves->bindParam(':temperature', $temperature);
    $stmtReleves->bindParam(':humidite', $humidite);
    $stmtReleves->bindParam(':idSonde', $idSonde);
    $result = $stmtReleves->execute();

    if($result){
        echo 'Insertion des relevés réussie.';
    }else{
        echo `Erreur, les insertions des relevés n'a pas été effectuée`;
    }

}

// insertReleves($dateRelevee, $temperature, $humidite, 1);

function getSelectReleves($idReleves) {
    global $BDD;

    
    $queryReleves = "SELECT * FROM Releves WHERE ID = :idReleves";
    $stmtReleves = $BDD->prepare($queryReleves);
    $stmtReleves->bindParam(':idReleves', $idReleves);
    $stmtReleves->execute();

    return $stmtReleves->fetch(PDO::FETCH_ASSOC);
}




// $releves = getSelectReleves(1);
// print_r($releves);

//Boucle permettant de créer/insérer un jeu de données sur les 5 derniers jours

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

//     //-------------------------------------------------------------------//
//     $jsonData = generateRaspberryData1();
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
    

//     //-------------------------------------------------------------------//
//     $jsonData = generateRaspberryData2();
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

//     //-------------------------------------------------------------------//
//     $jsonData = generateRaspberryData3();
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
    
//     //-------------------------------------------------------------------//
//     $jsonData = generateRaspberryData4();
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