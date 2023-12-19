<?php


include_once '../scrypt/scrypt.php';
include_once '../templates/connect.php';

$jsonData = generateRaspberryData();

if ($jsonData !== null) {
    $data = json_decode($jsonData, true);

    if ($data !== null) {
        $deviceName = $data['deviceName'];
        $temperature = $data['temperature'];
        $humidity = $data['humidity'];
    } else {
        echo "Erreur lors du décodage des données JSON.";
    }
} else {
    echo "Erreur provenant du scrypt Raspberry";
}



// // Fonction pour insérer un Raspberry
// function insertRaspberry($nom) {
//     global $BDD;

//     $query = "INSERT INTO Raspberry (Nom) VALUES (:nom)";
//     $stmt = $BDD->prepare($query);
//     $stmt->bindParam(':nom', $nom);

//     // Exécute la requête et stocke le résultat dans une variable
//     $result = $stmt->execute();

//     if ($result) {
//         echo 'Insertion réussie.';
//     } else {
//         echo 'Échec de l\'insertion.';
//     }

//     return $result;
// }

// insertRaspberry($deviceName);

// function getRaspberryById($idRaspberry){
//     global $BDD;

//     $raspberryQuery = "SELECT * FROM Raspberry WHERE ID = :id";
//     $raspberryStmt = $BDD->prepare($raspberryQuery);
//     $raspberryStmt->bindParam(':id', $idRaspberry);
//     $raspberryStmt->execute();

//     return $raspberryStmt->fetch(PDO::FETCH_ASSOC);
// }

// $raspberry = getRaspberryById(1);
// print_r($raspberry);

// // Fonction pour insérer une Sonde
// function insertSonde($nom, $idRaspberry) {
//     global $BDD;

//     $query = "INSERT INTO Sonde (nom, ID_Raspberry) VALUES (:nom, :idRaspberry)";

//     $stmt = $BDD->prepare($query);
//     $stmt->bindParam(':nom', $nom);
//     $stmt->bindParam(':idRaspberry', $idRaspberry);

//     $result = $stmt->execute();

//     if ($result) {
//         echo 'Insertion réussie.';
//     } else {
//         $errorInfo = $stmt->errorInfo();
//         echo 'Échec de l\'insertion.';
//     }

//     return $result;
// }


// insertSonde("NomDeLaSonde", 1);

// // Fonction pour lire une Sonde par son ID
// function getSondeById($id) {
//     global $BDD;

//     $query = "SELECT * FROM Sonde WHERE ID = :id";
//     $stmt = $BDD->prepare($query);
//     $stmt->bindParam(':id', $id);
//     $stmt->execute();

//     return $stmt->fetch(PDO::FETCH_ASSOC);
// }
// $sonde = getSondeById(1);
// print_r($sonde)

// // // Fonction pour mettre à jour une Sonde
// function updateSonde($id, $nom, $idRaspberry) {
//     global $BDD;

//     $query = "UPDATE Sonde SET nom = :nom, ID_Raspberry = :idRaspberry WHERE ID = :id";
//     $stmt = $BDD->prepare($query);
//     $stmt->bindParam(':id', $id);
//     $stmt->bindParam(':nom', $nom);
//     $stmt->bindParam(':idRaspberry', $idRaspberry);

//     $result = $stmt->execute();

//     if ($result) {
//         echo 'Mise à jour réussie.';
//     } else {
//         echo 'Échec de la mise à jour.';
//     }

//     return $result;
// }

// updateSonde(1, "NouveauNom", 1);


// Fonction pour insérer une Température
//INSERT INTO votre_table (colonne_datetime)
('2023-01-01 12:30:00');
function insertTemperature($datetime, $valeur) {
    global $conn;

    $query = "INSERT INTO Temperature (Date, Valeur) VALUES (:datetime, :valeur)";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':datetime', $datetime);
    $stmt->bindParam(':valeur', $valeur);

    return $stmt->execute();
}
// // Fonction pour insérer une Humidité
// function insertHumidite($date, $heure, $valeur) {
//     global $conn;

//     $query = "INSERT INTO Humidite (Date, Heure, Valeur) VALUES (:date, :heure, :valeur)";
//     $stmt = $conn->prepare($query);
//     $stmt->bindParam(':date', $date);
//     $stmt->bindParam(':heure', $heure);
//     $stmt->bindParam(':valeur', $valeur);

//     return $stmt->execute();
// }

// // Fonction pour insérer une Analyse
// function insertAnalyse($idSonde, $idTemperature, $idHumidite) {
//     global $conn;

//     $query = "INSERT INTO Analyse (ID, ID_Temperature, ID_Humidite) VALUES (:idSonde, :idTemperature, :idHumidite)";
//     $stmt = $conn->prepare($query);
//     $stmt->bindParam(':idSonde', $idSonde);
//     $stmt->bindParam(':idTemperature', $idTemperature);
//     $stmt->bindParam(':idHumidite', $idHumidite);

//     return $stmt->execute();
// }

// // Exemple d'utilisation :

// // Insertion d'une Raspberry
// insertRaspberry("Raspberry1");

// // Insertion d'une Sonde liée à la Raspberry1
// $idRaspberry = 1;
// insertSonde("Sonde1", $idRaspberry);

// // Insertion d'une Température
// insertTemperature("2023-01-01", "12:00:00", 25.5);

// // Insertion d'une Humidité
// insertHumidite("2023-01-01", "12:00:00", 60.5);

// // Insertion d'une Analyse liée à la Sonde1, Température et Humidité
// $idSonde = 1;
// $idTemperature = 1;
// $idHumidite = 1;
// insertAnalyse($idSonde, $idTemperature, $idHumidite);

?>