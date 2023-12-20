<?php

include_once __DIR__ . '/DbConnect.php';

function insertReleves($date, $temperature, $humidite, $idSonde) {
    global $db;

    // Insérer dans la table Releves
    $queryReleves = "INSERT INTO Releves (Date, Temperature, Humidite, ID_Sonde) VALUES (:date, :temperature, :humidite, :idSonde)";
    $stmtReleves = $db->prepare($queryReleves);
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

function getSelectReleves($idReleves) {
    global $db;

    
    $queryReleves = "SELECT * FROM Releves WHERE ID = :idReleves";
    $stmtReleves = $db->prepare($queryReleves);
    $stmtReleves->bindParam(':idReleves', $idReleves);
    $stmtReleves->execute();

    return $stmtReleves->fetch(PDO::FETCH_ASSOC);
}

// $releves = getSelectReleves(1);
// print_r($releves);
// insertReleves($dateRelevee, $temperature, $humidite, 1);