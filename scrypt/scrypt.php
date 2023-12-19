<?php

function generateRaspberryData() {
    $temperature = rand(0, 50) + (rand(0, 99) / 100); // Simule une température entre 0 et 50
    $humidity = rand(0, 100); // Simule une humidité entre 0 et 100`
    $h = date("h")+1;
    $date = date("Y-m-d ".$h.":i:s");

    $data = [
        'id' => 1,
        'deviceName' => 'Sonde',
        'temperature' => $temperature,
        'date'=> $date,
        'humidity' => $humidity
    ];
    return json_encode($data);
}

// function raspberryPeriodically() {
//     echo generateRaspberryData() . PHP_EOL;

//     // Exécute la génération de données toutes les 5 minutes
//     while (true) {
//         sleep(5 * 60);
//         $randomData = generateRaspberryData();
//         echo $randomData . PHP_EOL;
//     }
// }

// // Appeler la fonction pour exécuter le script périodiquement
// raspberryPeriodically();