<?php
include_once('toolbox.php');
///


$date_debut = $_GET['combo1'];
$date_fin = $_GET['combo2'];

if (isset($_GET['idSonde'])) {
    $idSonde = $_GET['idSonde'];
} else {
    echo "Aucun ID n'a été spécifié dans l'URL.";
}
$idSondeUrl = $idSonde;
$apiUrlRelevesSonde = 'http://api.localhost:9530/apiRest.php?resource=releves_periode&idSonde=' . $idSondeUrl.'&date_debut='.$date_debut.'&date_fin='.$date_fin;
$ch = curl_init($apiUrlRelevesSonde);

$options = [
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_HTTPHEADER => ['Content-Type: application/json'],
];

curl_setopt_array($ch, $options);

$response = curl_exec($ch);
curl_close($ch);

$data = json_decode($response, true);

//////

// echo "Données récupérées : <pre>";
// print_r($data);
// echo "</pre>";
echo $data;



// $post_data = json_encode($data = [
//     'date_debut' => $date_debut,
//     'date_fin' => $date_fin,
// ]);
// $ch = curl_init();

// $options = [
//     // CURLOPT_URL => 'http://api.localhost:9530/apiRest.php?resource=releves_periode&idSonde=' . $idSondeUrl.'&date_debut='.$date_debut.'&date_fin='.$date_fin,
//     CURLOPT_URL => 'http://api.localhost:9530/apiRest.php?resource=releves_periode&idSonde=1&date_debut=2023-12-16&date_fin=2023-12-19',
//     CURLOPT_POST => 1,
//     CURLOPT_POSTFIELDS => $post_data,
//     CURLOPT_RETURNTRANSFER => 1,
//     CURLOPT_HTTPHEADER => array('Content-Type: application/json'),
// ];
// curl_setopt_array($ch, $options);
// $result = curl_exec($ch);
// curl_close($ch);
// $data = json_decode($result,true);
// print_r($data);


echo "Toutes les températures de la période donnée ";

function recentDate(){
    $day = date('d');
    $today = date("Y-m-d");
    $response = [];
    $response[] = $today;
    for($i=1;$i<=4;$i++){
        $ajout = date('Y-m-'.$day-$i);
        $response[] = $ajout;
    }
    return $response;
}

function displayArray($array){
    for($i=0;$i<count($array);$i++){
        echo '<option>'.$array[$i].'</option>';
    }
}

$date_array = recentDate();

?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="../CSS/styles.css" />
    <link rel="stylesheet" href="../CSS/charts.min.css" />
    <title>Température</title>
</head>

<body>
    <div class="mainTemperature">
        <div class="temperature">
            <h2>Sélectionnez une date :</h2>
            <form method="get">
                <select name="combo1">
                    
                    <?php displayArray(array_reverse($date_array)) ?>
                    <!-- Ajoutez d'autres options selon vos besoins -->
                </select>
                <select name="combo2">
                    <?php displayArray($date_array) ?>
                    <!-- Ajoutez d'autres options selon vos besoins -->
                </select>
                <input type="hidden" name="idSonde" value="1">
                <input type='submit' value='Afficher'>
            </form>
            <br />
            <div id="temperature"><p><?php echo "Période de ".$date_debut." à ".$date_fin; ?></p></div>
            <h1>Quelle température:</h1>
            <p>Jetez un oeil à la température sur la période selectionnée.</p>

            
            <form method="get" action="http://api.localhost:9530/apirest.php">
                <input type="hidden" name="resource" value="releves">
                <input type="hidden" name="idSonde" value="1">
                <input type="submit" value="Afficher le graphique">
            </form>


            <table class="charts-css line show-primary-axis show-10-secondary-axes  show-labels  show-heading">
                <tbody>
                    <?php

                    ?>
                </tbody>
            </table>
        </div>
    </div>

    <div class="accueil">
        <a href="index.html"><img src="../images/maison.svg" /></a>
    </div>
</body>

</html>
