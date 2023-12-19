<?php


include_once '../scrypt/scrypt.php';
include_once '../templates/connect.php';

$jsonData = generateRaspberryData();

if ($jsonData !== null) {
    $data = json_decode($jsonData, true);

    if ($data !== null) {
        $deviceName = $data['deviceName'];
        $temperature = $data['temperature'];
        $date = $data['date'];
        $humidity = $data['humidity'];
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

    // Exécute la requête et stocke le résultat dans une variable
    $result = $stmt->execute();

    if ($result) {
        echo 'Insertion de la nouvelle sonde réussie.';
    } else {
        echo 'Échec de l\'insertion.';
    }

    return $result;
}

insertSonde($deviceName);

// Fonction pour récupérer la sonde selon son id
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

    // Exécute la requête et stocke le résultat dans une variable
    $result = $stmt->execute();

    if ($result) {
        echo 'Mise à jour de la sonde réussie.';
    } else {
        echo 'Échec de la mise à jour.';
    }

    return $result;
}

//$sonde = updateSonde(1, "jj");
?>