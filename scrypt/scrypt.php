<?php

function generateRaspberryData() {
    $temperature = rand(0, 40) + (rand(0, 90) / 100); // Simule une température entre 0 et 50
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

function generateRaspberryData1() {
    $temperature = rand(0, 40) + (rand(0, 90) / 100); // Simule une température entre 0 et 50
    $humidity = rand(0, 100); // Simule une humidité entre 0 et 100`
    $d = date('d')-1;
    $h = date("h")+1;
    $date = date("Y-m-".$d." ".$h.":i:s");

    $data = [
        'id' => 1,
        'deviceName' => 'Sonde',
        'temperature' => $temperature,
        'date'=> $date,
        'humidity' => $humidity
    ];
    return json_encode($data);
}

function generateRaspberryData2() {
    $temperature = rand(0, 40) + (rand(0, 90) / 100); // Simule une température entre 0 et 50
    $humidity = rand(0, 100); // Simule une humidité entre 0 et 100`
    $d = date('d')-2;
    $h = date("h")+1;
    $date = date("Y-m-".$d." ".$h.":i:s");

    $data = [
        'id' => 1,
        'deviceName' => 'Sonde',
        'temperature' => $temperature,
        'date'=> $date,
        'humidity' => $humidity
    ];
    return json_encode($data);
}

function generateRaspberryData3() {
    $temperature = rand(0, 40) + (rand(0, 90) / 100); // Simule une température entre 0 et 50
    $humidity = rand(0, 100); // Simule une humidité entre 0 et 100`
    $d = date('d')-3;
    $h = date("h")+1;
    $date = date("Y-m-".$d." ".$h.":i:s");

    $data = [
        'id' => 1,
        'deviceName' => 'Sonde',
        'temperature' => $temperature,
        'date'=> $date,
        'humidity' => $humidity
    ];
    return json_encode($data);
}

function generateRaspberryData4() {
    $temperature = rand(0, 40) + (rand(0, 90) / 100); // Simule une température entre 0 et 50
    $humidity = rand(0, 100); // Simule une humidité entre 0 et 100`
    $d = date('d')-4;
    $h = date("h")+1;
    $date = date("Y-m-".$d." ".$h.":i:s");

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