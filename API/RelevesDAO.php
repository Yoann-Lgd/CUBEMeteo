<?php

require('DbConnect.php');


//Insertion des relevés en recevant 4 paramètre : la date, la température, l'humidité et l'id de la sonde concernée
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

//Fonction qui a pour but de fournir toutes les informations d'un relevé par le biais de son id passé en paramètre
function getRelevesByID($idReleves) {
    global $db;

    $queryReleves = "SELECT * FROM Releves WHERE ID = :idReleves";
    $stmtReleves = $db->prepare($queryReleves);
    $stmtReleves->bindParam(':idReleves', $idReleves);
    $stmtReleves->execute();

    return $stmtReleves->fetch(PDO::FETCH_ASSOC);
}

//Fonction qui a pour but de fournir toutes les relevés d'une sonde selectionnée par son id 
function getRelevesBySonde($idSonde) {
    global $db;

    
    $queryReleves = "SELECT * FROM Releves WHERE ID_Sonde = :idSonde";
    $stmtReleves = $db->prepare($queryReleves);
    $stmtReleves->bindParam(':idSonde', $idSonde);
    $stmtReleves->execute();

    return $stmtReleves->fetchAll(PDO::FETCH_ASSOC);
}

// Fonction pour récupérer les relevés entre une date de début et une date de fin pour une sonde spécifique
function getRelevesBetweenDates($idSonde, $dateDebut, $dateFin) {
    global $db;
    $query = "SELECT * FROM Releves WHERE ID_Sonde = :idSonde AND Date BETWEEN :dateDebut AND :dateFin";

    $stmt = $db->prepare($query);
    $stmt->bindParam(':idSonde', $idSonde);
    $stmt->bindParam(':dateDebut', $dateDebut);
    $stmt->bindParam(':dateFin', $dateFin);

    $stmt->execute();

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}


//Fonction qui a pour but de fournir les relevés 
// function getDateUnique(){
//     global $db;

//     $queryReleves = "SELECT DISTINCT LEFT(Releves,10) FROM releves ORDER BY Releves ASC";
//     $stmtReleves = $db->prepare($queryReleves);
//     $stmtReleves->execute();

//     return $stmtReleves->fetchAll(PDO::FETCH_ASSOC);
// }
// // Exemple d'utilisation
// $idSonde = 1; // ID de la sonde
// $dateDebut = '2023-12-17 00:00:00'; // Date de début
// $dateFin = '2023-12-20 23:59:59'; // Date de fin

// $releves = getRelevesBetweenDates($idSonde, $dateDebut, $dateFin);

// // Traiter les relevés récupérés
// foreach ($releves as $releve) {
//     $date = $releve['Date'];
//     $temperature = $releve['Temperature'];
//     $humidite = $releve['Humidite'];

//     echo "Date: $date, Température: $temperature, Humidité: $humidite<br>";
// }

// $releves = getSelectReleves(1);
// print_r($releves);
// insertReleves($dateRelevee, $temperature, $humidite, 1);