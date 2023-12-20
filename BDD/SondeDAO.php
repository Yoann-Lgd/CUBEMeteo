<?php

require('DbConnect.php');

// Fonction pour insérer une Sonde
function insertSonde($nom) {
    global $db;

    $query = "INSERT INTO Sonde (Nom) VALUES (:nom)";
    $stmt = $db->prepare($query);
    $stmt->bindParam(':nom', $nom);

    $result = $stmt->execute();

    if ($result) {
        echo 'Insertion de la nouvelle sonde réussie.';
    } else {
        echo 'Échec de l\'insertion.';
    }

    return $result;
}

//Fonction pour récupérer la sonde selon son id
function getSondeById($idSonde){
    global $db;

    $sondeQuery = "SELECT * FROM Sonde WHERE ID = :id";
    $sondeStmt = $db->prepare($sondeQuery);
    $sondeStmt->bindParam(':id', $idSonde);
    $sondeStmt->execute();

    return $sondeStmt->fetch(PDO::FETCH_ASSOC);
}

// Fonction pour mettre à jour la sonde selon son id
function updateSonde($id, $nom) {
    global $db;

    $query = "UPDATE Sonde SET nom = :nom WHERE ID = :id";
    $stmt = $db->prepare($query);
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

// insertSonde($deviceName);
// $sonde = getSondeById(1);
// print_r($sonde);
// $sonde = updateSonde(1, "jj");