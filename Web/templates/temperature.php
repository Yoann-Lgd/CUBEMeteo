<?php
//Importation des modules


require_once('../../API/apiRest.php');






$array_temp = [];
$heure = [];

foreach($array_releves as $releves){ //on récupère toutes les températures dans une array et toutes les heures dans une autre array
$temperature = $releves['Temperature'];
$array_temp[] = $temperature;
$h = $releves['Date'];
$heure[] = substr($h,-8);
}
 

if($date_debut == date("Y-m-d") And $date_fin == $date_debut){
    $answer = "Veuillez selectionner deux dates";
}elseif($date_debut != ""){
    $answer = "Voici le graphique des températures relevés entre le ".$date_debut." et le ".$date_fin; //phrase de synthèse
}



$lastDaysAvTemp = substr(averageFromArray($array_temp),0,4); //température moyenne sur la période donnée

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
                <select name="combo1" >
                    <option value="">Tout</option>
                    <?php
                    $date_array = dateUniqueReverse($db,'Date');
                    for($i=0;$i < count($date_array);$i++){
                    echo "<option>".$date_array[$i]."</option>";
                    }
                    ?>
                    <!-- Ajoutez d'autres options selon vos besoins -->
                </select>
                <select name="combo2" >
                    <option value="">Tout</option>
                    <?php
                    $date_array = dateUnique($db,'Date');
                    for($i=0;$i < count($date_array);$i++){
                    echo "<option>".$date_array[$i]."</option>";
                    }
                    ?>
                    <!-- Ajoutez d'autres options selon vos besoins -->
                </select>

                <input type='submit' value='Afficher'>
            </form>
            <br />
            <div id="temperature"><b><?php echo $answer;?></b></div>
            <h1>Quelle température:</h1>
            <p>Jettez un oeil à la température sur la période selectionnée.</p>

            <table class="charts-css line show-primary-axis show-10-secondary-axes  show-labels  show-heading">

                <tbody>
                    <?php
                    $cpt = 0;
                    for($i = 0;$i<(count($array_temp)-1);$i++){
                        //pour tout les points
                        $cpt++;
                        
                        if(count($heure)>=30){//si il y a moins de 15pts à placer
                            if($cpt == 7){//si 2 itérations ont été faites :
                                $point_name = "";
                                $title_point ="";
                                $cpt = 0;
                            }else{
                                $title_point = "";
                                $point_name = "";
                            }

                        }elseif(count($heure)>=10){
                            
                            $title_point = "";
                            $point_name = $array_temp[$i];
                        }
                        elseif(count($heure)<=10){
                            
                            $title_point = $heure[$i];
                            $point_name = $array_temp[$i];
                        }
                        $start = "0.". (int)$array_temp[$i];
                        $end = "0.". (int)$array_temp[$i+1];
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

            <p>
                <?php echo "La température moyenne entre ces dates est de ".$lastDaysAvTemp . "°C"; ?>.
            </p>
            <?php picto($lastDaysAvTemp)?>
            <!-- <img src="../images/rire.svg" /> -->
        </div>
    </div>

    <div class="accueil">
        <a href="index.html"><img src="../images/maison.svg" /></a>
    </div>
</body>

</html>