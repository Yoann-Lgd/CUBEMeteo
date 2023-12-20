<?php

require('DbConnect.php');

    // Fonction pour insérer une Sonde
    function insertSonde($nom) {
        global $db;

        $query = "INSERT INTO Sonde (Nom) VALUES (:nom)";
        $stmt = $db->prepare($query);
        $stmt->bindParam(':nom', $nom);

        $result = $stmt->execute();

        return $result;
    }

    // Fonction pour récupérer la sonde selon son id
    function getAllSonde() {
        global $db;

        $sondeQuery = "SELECT * FROM Sonde";
        $sondeStmt = $db->prepare($sondeQuery);
        $sondeStmt->execute();

        return $sondeStmt->fetch(PDO::FETCH_ASSOC);
    }
    
    // Fonction pour récupérer la sonde selon son id
    function getSondeById($idSonde) {
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

        return $result;
    }

