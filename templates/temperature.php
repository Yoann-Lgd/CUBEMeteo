<?php

/*CONNECTION AVEC LA BDD MYSQL*/

require('connect.php'); /*Fichier contenant la fonction connect_to() qui permet de faire la connection avec la BDD*/
require('toolbox.php'); // Module toolbox qui contient les fonctions du script

$fiveDays = fiveDayBefore();
$actualDay = $fiveDays[0];
$todayAverage = averageTemp($BDD, 'releves',$actualDay);
echo $todayAverage;

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
            <h1>Quelle température:</h1>
            <p>Jettez un oeil à la température sur les dernières heures.</p>

            <table class="charts-css bar data-spacing-5 show-labels show-data-on-hover">
                <caption>
                    Température
                </caption>

                <tbody>
                    <tr>
                        <th scope="row">Test date</th>
                        <td style="--size: calc(<?php echo $todayAverage;?> / 40)">
                            <span class="data"><?php echo $todayAverage;?></span>
                            <span class="tooltip"><?php echo $todayAverage;?><br /></span>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row"></th>
                        <td style="--size: calc(20 / 40)">
                            <span class="data">20</span>
                            <span class="tooltip">data: 20<br />more info</span>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row"></th>

                        <td style="--size: calc(20 / 40)">
                            <span class="data">20</span>
                            <span class="tooltip">data: 20<br />more info</span>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row"></th>

                        <td style="--size: calc(20 / 40)">
                            <span class="data">20</span>
                            <span class="tooltip">data: 20<br />more info</span>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row"></th>

                        <td style="--size: calc(20 / 40)">
                            <span class="data">20</span>
                            <span class="tooltip">data: 20<br />more info</span>
                        </td>
                    </tr>
                </tbody>
            </table>

            <p>La température moyenne sur les 5 derniers jours était de&nbspX.</p>
            <img src="../images/rire.svg" />
        </div>
    </div>

    <div class="accueil">
        <a href="index.html"><img src="../images/maison.svg" /></a>
    </div>
</body>

</html>