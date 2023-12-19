<?php
//Importation des modules

require('connect.php'); //Fichier contenant la fonction connect_to() qui permet de faire la connection avec la BDD
require('toolbox.php'); // Module toolbox qui contient les fonctions du script



/*CONNECTION AVEC LA BDD MYSQL*/
$BDD = connect_to('cube_meteo');



//--------------------------------------------------------------------------------------------------------------------------------------//

$fiveDays = fiveDayBefore(); //on récupère les dates des 5 derniers jours

$graphArray = []; //initialisation de l'array qui va recevoir les moyennes d'humidité par jours

for($i = 0;$i < count($fiveDays);$i++){//On calcul l'humidité moyenne de chaques jour (itération de l'array des 5 dates)
    $jour = $fiveDays[$i];
    $averageCache = averageHumidity($BDD, 'releves',$jour);
    $graphArray[] = $averageCache;
}

$lastDaysAvHum = averageFromArray($graphArray); //Humidité moyenne sur les 5 derniers jours

?>


<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../CSS/styles.css">
    <link rel="stylesheet" href="../CSS/charts.min.css" />

    <title>Humidité</title>
</head>

<body>
    <div class="mainHumi">
        <div class="humidite">
            <h1>Quelle humidité:</h1>
            <p>Jettez un oeil à l’humidité sur les dernières heures.</p>
            <table class="charts-css bar data-spacing-5 show-labels show-data-on-hover">
                <caption>
                    Humidité
                </caption>

                <tbody>
                    <tr>
                        <th scope="row"><?php echo $fiveDays[0]; ?></th>
                        <td style="--size: calc(<?php echo $graphArray[0]; ?> / 100)">
                            <span class="data">
                            <?php echo $graphArray[0]."%"; ?>
                            </span>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row"><?php echo $fiveDays[1]; ?></th>
                        <td style="--size: calc(<?php echo $graphArray[1]; ?>/ 100)">
                            <span class="data"><?php echo $graphArray[1]."%"; ?></span>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row"><?php echo $fiveDays[2]; ?></th>

                        <td style="--size: calc(<?php echo $graphArray[2]; ?>/ 100)">
                            <span class="data"><?php echo $graphArray[2]."%"; ?></span>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row"><?php echo $fiveDays[3]; ?></th>

                        <td style="--size: calc(<?php echo $graphArray[3]; ?> / 100)">
                            <span class="data"><?php echo $graphArray[3]."%"; ?></span>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row"><?php echo $fiveDays[4]; ?></th>

                        <td style="--size: calc(<?php echo $graphArray[4]; ?> / 100)">
                            <span class="data"><?php echo $graphArray[4]."%"; ?></span>
                        </td>
                    </tr>
                </tbody>
            </table>
            <p>L’humidité moyenne sur les 5 derniers jours était de 
            <p class="averageHumidity">&nbsp<?php echo $lastDaysAvHum."%"?></p>.</p>
            <img src="../images/rire.svg" />

        </div>

    </div>

    <div class="accueil">
        <a href="index.html"><img src="../images/maison.svg"></a>
    </div>
</body>

</html>