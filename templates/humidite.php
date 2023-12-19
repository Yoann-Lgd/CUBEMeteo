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
                        <th scope="row">Test date</th>
                        <td style="--size: calc(<?php echo $todayAverage; ?> / 40)">
                            <span class="data">
                                <?php echo $todayAverage; ?>
                            </span>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row"></th>
                        <td style="--size: calc(20 / 40)">
                            <span class="data">20</span>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row"></th>

                        <td style="--size: calc(20 / 40)">
                            <span class="data">20</span>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row"></th>

                        <td style="--size: calc(20 / 40)">
                            <span class="data">20</span>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row"></th>

                        <td style="--size: calc(20 / 40)">
                            <span class="data">20</span>
                        </td>
                    </tr>
                </tbody>
            </table>
            <p>L’humidité moyenne sur les 5 derniers jours était de
            <p class="averageHumidity">&nbspX</p>.</p>
            <img src="../images/rire.svg" />

        </div>

    </div>

    <div class="accueil">
        <a href="index.html"><img src="../images/maison.svg"></a>
    </div>
</body>

</html>