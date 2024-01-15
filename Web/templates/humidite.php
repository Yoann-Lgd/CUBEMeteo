<?php
include_once('toolbox.php');

$date_debut = isset($_GET['date_debut']) ? $_GET['date_debut'] : '';
$date_fin = isset($_GET['date_fin']) ? $_GET['date_fin'] : '';

if (isset($_GET['idSonde'])) {
    $idSonde = $_GET['idSonde'];
} else {
    echo "Aucun ID n'a été spécifié dans l'URL.";
}

function recentDate() {
    $day = date('d');
    $today = date("Y-m-d");
    $response = [];
    $response[] = $today;
    for ($i = 1; $i <= 4; $i++) {
        $ajout = date('Y-m-d', strtotime("-$i days"));
        $response[] = $ajout;
    }
    return $response;
}

function displayArray($array) {
    for ($i = 0; $i < count($array); $i++) {
        echo '<option>' . $array[$i] . '</option>';
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
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/moment"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartjs-adapter-moment"></script>
</head>

<body>
    <div class="mainTemperature">
        <div class="temperature">
            <h2>Sélectionnez une date :</h2>
            <form method="get">
                <input type="hidden" name="idSonde" value="<?php echo $idSonde; ?>">
                <select name="date_debut">
                    <?php displayArray(array_reverse($date_array)) ?>
                </select>
                <select name="date_fin">
                    <?php displayArray($date_array) ?>
                </select>
                <input type='submit' value='Afficher' id="afficherBtn">
            </form>

            <br />
            <div id="temperature"><p><?php echo "Période de " . $date_debut . " à " . $date_fin; ?></p></div>
            <h1>Quelle humidité:</h1>
            <p>Jetez un œil à la température sur la période sélectionnée.</p>

            <!-- Ajoutez un canvas pour le graphique -->
            <canvas id="myChart" width="400" height="400"></canvas>
        </div>
    </div>

    <div class="accueil">
        <a href="index.html"><img src="../images/maison.svg" /></a>
    </div>

    <script>
        $(document).ready(function () {
            var ctx = document.getElementById('myChart').getContext('2d');
            var myChart;

            function updateTable() {
                var idSonde = $("input[name='idSonde']").val();
                var date_debut = $("select[name='date_debut']").val();
                var date_fin = $("select[name='date_fin']").val();

                console.log("ID Sonde:", idSonde);
                console.log("Date début:", date_debut);
                console.log("Date fin:", date_fin);

                $.getJSON("http://api.localhost:9530/apirest.php", {
                    resource: "releves_periode",
                    idSonde: idSonde,
                    date_debut: date_debut,
                    date_fin: date_fin
                }, function (data) {
                    console.log(idSonde, date_debut, date_fin);
                    // Extract data from JSON and format it for Chart.js
                    var labels = data.map(function (entry) {
                        return entry.Date;
                    });

                    var humidite = data.map(function (entry) {
                        return entry.Humidite;
                    });

                    if (myChart) {
                        myChart.destroy();
                    }

                    myChart = new Chart(ctx, {
                        type: 'bar',
                        data: {
                            labels: labels,
                            datasets: [{
                                label: 'Humidité',
                                data: humidite,
                                backgroundColor: 'rgba(75, 192, 192, 0.2)',
                                borderColor: 'rgba(75, 192, 192, 1)',
                                borderWidth: 1
                            }]
                        },
                        options: {
                            scales: {
                                xAxes: [{
                                    type: 'time',
                                    time: {
                                        unit: 'day',
                                        parser: 'YYYY-MM-DD HH:mm:ss',
                                        tooltipFormat: 'll HH:mm:ss'
                                    }
                                }],
                                y: {
                                    beginAtZero: true
                                }
                            }
                        }
                    });
                });
            }

            $("#afficherBtn").click(function (e) {
                e.preventDefault();
                updateTable();
            });

            updateTable();
        });
    </script>

</body>

</html>
