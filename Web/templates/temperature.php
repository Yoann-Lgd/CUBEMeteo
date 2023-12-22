<?php
include_once('toolbox.php');
///
if (isset($_GET['idSonde'])) {
    $idSonde = $_GET['idSonde'];
} else {
    echo "Aucun ID n'a été spécifié dans l'URL.";
}

$apiUrlRelevesSonde = 'http://api.localhost:9530/apirest.php?resource=releves&idSonde=' . $idSonde;
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

echo "Données récupérées : <pre>";
print_r($data);
echo "</pre>";

$date_debut = $_GET['combo1'];
$date_fin = $_GET['combo2'];

$post_data = json_encode($data = [
    'date_debut' => $date_debut,
    'date_fin' => $date_fin,
]);
$ch = curl_init();

$options = [
    CURLOPT_URL => 'http://apimeteo/apiRest.php',
    CURLOPT_POST => 1,
    CURLOPT_POSTFIELDS => $post_data,
    CURLOPT_RETURNTRANSFER => 1,
    CURLOPT_HTTPHEADER => array('Content-Type: application/json'),
];
curl_setopt_array($ch, $options);
$result = curl_exec($ch);
curl_close($ch);
echo $result;

echo "Toutes les températures de la période donnée ";
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
                    <option>2023-12-20</option>
                    <option>2023-12-16</option>
                    <!-- Ajoutez d'autres options selon vos besoins -->
                </select>
                <select name="combo2">
                    <option>2023-12-19</option>
                    <!-- Ajoutez d'autres options selon vos besoins -->
                </select>
                <input type='submit' value='Afficher'>
            </form>
            <br />
            <div id="temperature"><b><?php echo "période étudiée"; ?></b></div>
            <h1>Quelle température:</h1>
            <p>Jetez un oeil à la température sur la période selectionnée.</p>

            <h1>Quelle humidité:</h1>
            <p>Jetez un oeil à l’humidité sur la période selectionnée.</p>
            
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
