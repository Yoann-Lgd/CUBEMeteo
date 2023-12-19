<?php
try {
    $BDD = new PDO('mysql:host=localhost;dbname=cube_meteo', 'root', 'root');
    echo 'Connexion réussie à la base de données';


} catch (PDOException $erreur) {
    echo 'Echec de la connexion suite à l\'erreur suivante : ' . $erreur->getMessage();
    exit;
}

function connect_to($BddName){
    /* Créer une connection */
    $BDD = new PDO("mysql:host=localhost;dbname=".$BddName.";charset=utf8",
    'root',
    '');
    return $BDD;
}

