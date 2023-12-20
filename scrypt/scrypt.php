<?php

function generateRaspberryData() {
    $temperature = rand(0, 40) + (rand(0, 90) / 100); // Simule une température entre 0 et 50
    $humidite = rand(0, 100); // Simule une humidité entre 0 et 100`
    $h = date("h")+1;
    $date = date("Y-m-d ".$h.":i:s");

    $data = [
        'id' => 1,
        'deviceName' => 'Sonde',
        'temperature' => $temperature,
        'date'=> $date,
        'humidite' => $humidite
    ];
    return json_encode($data);
}

function generateDataForFiveDays() {
    $dateDeDepart = strtotime('now');
    $endDate = strtotime('-5 days');

    $dataList = [];

    while ($dateDeDepart >= $endDate) {
        $temperature = rand(10, 35) + (rand(0, 90) / 100);
        $humidite = rand(0, 100);
        $date = date('Y-m-d H:i:s', $dateDeDepart);
        
        $data = [
            'id' => 1,
            'deviceName' => 'Sonde',
            'temperature' => $temperature,
            'date' => $date,
            'humidite' => $humidite
        ];

        $dataList[] = $data;

        $dateDeDepart = strtotime('-30 minutes', $dateDeDepart);
    }

    return json_encode($dataList);
}



// function raspberryPeriodically() {
//     echo generateRaspberryData() . PHP_EOL;

//     // Exécute la génération de données toutes les 5 minutes
//     while (true) {
//         sleep(4 * 60 * 60);
//         $randomData = generateRaspberryData();
//         echo $randomData . PHP_EOL;
//     }
// }

// // Appeler la fonction pour exécuter le script périodiquement
// raspberryPeriodically();