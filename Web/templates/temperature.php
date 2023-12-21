<?php
include_once('toolbox.php');


$date_debut = $_GET['combo1'];
$date_fin = $_GET['combo2'];

$post_data = json_encode($data = [
    'date_debut'=>$date_debut,
    'date_fin'=>$date_fin]);
$ch = curl_init();

$options = [
    CURLOPT_URL=>'http://apimeteo/apiRest.php',
    CURLOPT_POST => 1,
    CURLOPT_POSTFIELDS => $post_data,
    CURLOPT_RETURNTRANSFER => 1,
    CURLOPT_HTTPHEADER => array('Content-Type: application/json')
];
curl_setopt_array($ch,$options);
$result = curl_exec($ch);
curl_close($ch);
echo $result;

echo "toutes les températures de la période donnée ";






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
            
                    <?php
                    //dates uniques en reverse
                    
                    ?>
                    <!-- Ajoutez d'autres options selon vos besoins -->
                </select>
                <select name="combo2" >
                    <option >2023-12-19</option>
                    <?php
                    //dates uniques
                    ?>
                    <!-- Ajoutez d'autres options selon vos besoins -->   
                </select>
                <input type='submit' value='Afficher'>
            </form>
            <br />
            <div id="temperature"><b><?php echo "période étudiée";?></b></div>
            <h1>Quelle température:</h1>
            <p>Jettez un oeil à la température sur la période selectionnée.</p>

            <table class="charts-css line show-primary-axis show-10-secondary-axes  show-labels  show-heading">

                <tbody>
                    <?php


                    ?>
                </tbody>
            </table>

            <p>
                <?php echo "La température moyenne entre ces dates est de "./*$lastDaysAvTemp*/ "°C"; ?>.
            </p>
            <?php //picto($lastDaysAvTemp)?>
            <!-- <img src="../images/rire.svg" /> -->
        </div>
    </div>

    <div class="accueil">
        <a href="index.html"><img src="../images/maison.svg" /></a>
    </div>
</body>

</html>