<?php

try {
    $db = new PDO('mysql:host=localhost;dbname=cube_meteo', 'root', '');


} catch (PDOException $erreur) {
    // echo 'Echec de la connexion suite à l\'erreur suivante : ' . $erreur->getMessage();
    header('Location: /templates/erreur.html',TRUE);
    exit;
}

// function connect_to($BddName){
//     /* Créer une connection */
//     $db = new PDO("mysql:host=localhost;dbname=".$BddName.";charset=utf8",
//     'root',
//     'root');
//     return $db;
// }