<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../CSS/styles.css">
    <link rel="stylesheet" href="../CSS/charts.min.css" />

    <title>humidité</title>
</head>

<body>
    <div class="mainHumi">
        <div class="humidite">
            <h1>Quelle humidité:</h1>
            <p>Jettez un oeil à l’humidité sur les dernières heures.</p>
            <div class="graph">
                <table class="charts-css column">

                    <caption> Température </caption>

                    <tbody>
                        <tr>
                            <td style="--size: calc( 40 / 100 )"> </td>
                        </tr>
                        <tr>
                            <td style="--size: calc( 60 / 100 )"> </td>
                        </tr>
                        <tr>
                            <td style="--size: calc( 75 / 100 )"> </td>
                        </tr>
                        <tr>
                            <td style="--size: calc( 90 / 100 )"> </td>
                        </tr>
                        <tr>
                            <td style="--size: calc( 100 / 100 )"> </td>
                        </tr>
                    </tbody>

                </table>
            </div>
            <p>L’humidité moyenne sur les 5 derniers jours était de
            <p class="averageHumidity">&nbspX</p>.</p>
        </div>

    </div>

    <div class="accueil">
        <a href="index.html"><img src="../images/maison 1.svg"></a>
    </div>
</body>

</html>