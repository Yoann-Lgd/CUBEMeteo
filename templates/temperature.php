<?php
//Importation des modules

require('connect.php'); //Fichier contenant la fonction connect_to() qui permet de faire la connection avec la BDD
require('toolbox.php'); // Module toolbox qui contient les fonctions du script



/*CONNECTION AVEC LA BDD MYSQL*/
$BDD = connect_to('cube_meteo');


//----------------------------------------------------------------------------------------//

$fiveDays = fiveDayBefore(); //on récupère les dates des 5 derniers jours


$graphArray = []; //initialisation de l'array qui va recevoir les moyennes des températures par jours

for ($i = 0; $i < count($fiveDays); $i++) { //On calcul la température moyenne de chaques jour (itération de l'array des 5 dates)
    $jour = $fiveDays[$i];
    $averageCache = averageTemp($BDD, 'releves', $jour);
    $graphArray[] = $averageCache;
}

$lastDaysAvTemp = averageFromArray($graphArray); //température moyenne sur les 5 derniers jours

if (isset($_GET['combo'])) {              //test si l'entrée est faite par l'utilisateur
    $date_input = $_GET['combo'];
    $answer = searchTemp($BDD, $date_input, 'releves');
} else {
    $answer = "Choisissez une date";
}



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
                <select name="combo">
                    <?php
                    $date_array = dateUnique($BDD, 'Date');
                    for ($i = 0; $i <= count($date_array) + 1; $i++) {
                        echo "<option>" . $date_array[$i] . "</option>";
                    } ?>
                    <!-- Ajoutez d'autres options selon vos besoins -->
                </select>
                <input type='submit' value="Chercher">
            </form>
            <br />
            <div id="temperature"><b>
                    <?php echo $answer; ?>
                </b></div>
            <h1>Quelle température:</h1>
            <p>Jettez un oeil à la température sur les derniers jours.</p>

            <table class="charts-css line show-labels show-data-on-hover">
                <caption>
                    Température
                </caption>

                <tbody>
                    <tr>
                        <th scope="row">
                            <?php echo $fiveDays[0]; ?>
                        </th>
                        <td style="--size: calc(<?php echo $graphArray[0]; ?> / 40)">
                            <span class="data">
                                <?php echo $graphArray[0] . "°C"; ?>
                            </span>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">
                            <?php echo $fiveDays[1]; ?>
                        </th>
                        <td style="--size: calc(<?php echo $graphArray[1]; ?>/ 40)">
                            <span class="data">
                                <?php echo $graphArray[1] . "°C"; ?>
                            </span>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">
                            <?php echo $fiveDays[2]; ?>
                        </th>

                        <td style="--size: calc(<?php echo $graphArray[2]; ?> / 40)">
                            <span class="data">
                                <?php echo $graphArray[2] . "°C"; ?>
                            </span>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">
                            <?php echo $fiveDays[3]; ?>
                        </th>

                        <td style="--size: calc(<?php echo $graphArray[3]; ?> / 40)">
                            <span class="data">
                                <?php echo $graphArray[3] . "°C"; ?>
                            </span>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">
                            <?php echo $fiveDays[4]; ?>
                        </th>

                        <td style="--size: calc(<?php echo $graphArray[4]; ?> / 40)">
                            <span class="data">
                                <?php echo $graphArray[4] . "°C"; ?>
                            </span>
                        </td>
                    </tr>
                </tbody>
            </table>

            <p>La température moyenne sur les 5 derniers jours était de&nbsp
                <?php echo $lastDaysAvTemp . "°C"; ?>.
            </p>
            <img src="../images/rire.svg" />
        </div>
    </div>

    <div class="accueil">
        <a href="index.html"><img src="../images/maison.svg" /></a>
    </div>
</body>

</html>