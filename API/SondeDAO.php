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

    // Fonction pour récupérer toutes les sondes
    function getAllSonde() {
        global $db;

        $sondeQuery = "SELECT * FROM Sonde";
        $sondeStmt = $db->prepare($sondeQuery);
        $sondeStmt->execute();

        return $sondeStmt->fetchAll(PDO::FETCH_ASSOC);
    }
        
    // Fonction pour récupérer les informations propres à la table sonde selon son id
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

    //Fonction pour supprimer une sonde en passant son id en paramètre de celle-ci, on supprime d'abord tous les relevés liés à la sonde pour éviter les erreurs liées à 
    // une violation de contrainte de données lié à la FK présente dans la table Releves
    function deleteSondeById($id) {
        global $db;

        // on vérifie si des relevés liés à la sonde selectionnée existe dans la table Releves
        $checkQuery = "SELECT COUNT(*) as count FROM Releves WHERE ID_Sonde = :id";
        $checkStmt = $db->prepare($checkQuery);
        $checkStmt->bindParam(':id', $id);
        $checkStmt->execute();
        $rowCount = $checkStmt->fetch(PDO::FETCH_ASSOC)['count'];

        // Si des relevées existent, on supprime tous les relevés liés à 
        if ($rowCount > 0) {
            $deleteRelevesQuery = "DELETE FROM Releves WHERE ID_Sonde = :id";
            $deleteRelevesStmt = $db->prepare($deleteRelevesQuery);
            $deleteRelevesStmt->bindParam(':id', $id);
            $deleteRelevesStmt->execute();
        }

        // Suppresion de la sonde
        $deleteSondeQuery = "DELETE FROM Sonde WHERE ID = :id";
        $deleteSondeStmt = $db->prepare($deleteSondeQuery);
        $deleteSondeStmt->bindParam(':id', $id);
        $result = $deleteSondeStmt->execute();

        return $result;
    }