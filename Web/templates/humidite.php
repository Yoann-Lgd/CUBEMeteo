<?php
//Importation des modules

require('../API/apiRest.php'); //Fichier contenant la fonction connect_to() qui permet de faire la connection avec la BDD



/*CONNECTION AVEC LA BDD MYSQL*/
$BDD = $db;



//--------------------------------------------------------------------------------------------------------------------------------------//

$fiveDays = fiveDayBefore(); //on récupère les dates des 5 derniers jours

$graphArray = []; //initialisation de l'array qui va recevoir les moyennes d'humidité par jours

for($i = 0;$i < count($fiveDays);$i++){//On calcul l'humidité moyenne de chaques jour (itération de l'array des 5 dates)
    $jour = $fiveDays[$i];
    $averageCache = averageHumidity($BDD, 'releves',$jour);
    $graphArray[] = $averageCache;
}

$lastDaysAvHum = averageFromArray($graphArray); //Humidité moyenne sur les 5 derniers jours
if(isset($_GET['combo'])){              //test si l'entrée est faite par l'utilisateur
    $date_input = $_GET['combo'];    
    $answer = searchTemp($BDD,$date_input,'releves');
    $cursor = $BDD->query("SELECT Humidite FROM releves WHERE Date LIKE '%" . $date_input . "%'");
    $data_temp = $cursor->fetchAll(PDO::FETCH_DEFAULT);;

    $cursor = $BDD->query("SELECT Date FROM releves WHERE Date LIKE '%" . $date_input . "%'");
    $data_hour = $cursor->fetchAll(PDO::FETCH_DEFAULT);;

    $title_point = " ";
    // if(count($data_temp)<10){
    //     $title_point = substr($data_hour[$i][0],-8);
    // } 
    
    
} else {
    $answer = "Choisissez une date";
    $data_temp = [[0,0,0,0,0],[0,0,0,0,0]];
    $date_input = "";
    $data_hour = [[0,0,0,0,0,0,0,0,0,0,0,0,0],[0,0,0,0,0,0,0,0,0,0,0,0,0]];
}
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
        <h2>Sélectionnez une date :</h2>
        <form>
                <select name="combo" >
                    <option value="">Tout</option>
                    <?php
                    $date_array = dateUnique($BDD,'Date');
                    for($i=0;$i <= count($date_array)+1;$i++){
                    echo "<option>".$date_array[$i]."</option>";
                    }
                    ?>
                    <!-- Ajoutez d'autres options selon vos besoins -->
                </select>
                <input type='submit' value='Afficher'>
            </form>
            <br />
            <h1>Quelle humidité:</h1>
            <p>Jettez un oeil à l’humidité sur les dernières heures.</p>
            <table class="charts-css line show-primary-axis show-2-secondary-axes show-data-axes show-labels  show-heading">
                <caption>
                    Température
                </caption>

                <tbody>
                    <?php
                    $cpt = 0;
                    for($i = 0;$i<(count($data_temp)-1);$i++){
                        //pour tout les points
                        $cpt++;
                        if(count($data_hour)>=15){//si il y a moins de 15pts à placer
                            if($cpt == 2){//si 2 itérations ont été faites :
                                $point_name = $data_temp[$i][0];
                                $title_point ="";
                                $cpt = 0;
                            }else{
                                $title_point = "";
                                $point_name = "";
                            }

                        }elseif(count($data_hour)<=10){
                            
                            $title_point = substr($data_hour[$i][0],-8);
                            $point_name = $data_temp[$i][0];
                        }
                        $start = "0.". (int)$data_temp[$i][0];
                        $end = "0.". (int)$data_temp[$i+1][0];
                        echo('
                        <tr>
                        <th scope = "row">'.$title_point.'</th>
                        <td style="--start: '.$start.'; --end: '.$end.';">'.$point_name.'</td>
                        </tr>
                        
                        ');

                    }

                    ?>
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