<?php

error_reporting(E_ERROR | E_PARSE);

$lieux = json_decode(file_get_contents("assets/data/lieux-2021.json"),true);
$carac = json_decode(file_get_contents("assets/data/carcteristiques-2021.json"),true);
$usagers = json_decode(file_get_contents("assets/data/usagers-2021.json"),true);
$vehicules = json_decode(file_get_contents("assets/data/vehicules-2021.json"),true);

$etat_pers = array(
    array(0,0), //place du conducteur ID = 0
    array(0,0), //place du passagers avant
    array(0,0), //place du passagers arrière droite
    array(0,0), //place du passagers arrière gauche
    array(0,0) //place du passagers arrière millieu
  );

  $depart = 0;
  //$iteration = 1000000;

  $iteration = count($usagers);


for ($i=$depart; $i < $iteration; $i++) { 
    
    //grav, place



    if($usagers[$i]['grav'] == 2){

        $etat_pers[$usagers[$i]['place']-1][0] = $etat_pers[$usagers[$i]['place']-1][0] + 1;

    }else{

        $etat_pers[$usagers[$i]['place']-1][1] = $etat_pers[$usagers[$i]['place']-1][1] + 1;

    }


}



//var_dump($etat_pers);


?>



<html>
  <head>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['bar']});
      google.charts.setOnLoadCallback(drawChart);
      google.charts.setOnLoadCallback(drawChart2);

      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Place', 'Vivants', 'Morts'],
          ['Conducteur', <?= $etat_pers[0][1] ?>, <?= $etat_pers[0][0] ?>],
          ['Passager avant', <?= $etat_pers[1][1] ?>, <?= $etat_pers[1][0] ?>],
          ['Passager arrière droite', <?= $etat_pers[2][1] ?>, <?= $etat_pers[2][0] ?>],
          ['Passager arrière gauche', <?= $etat_pers[3][1] ?>, <?= $etat_pers[3][0] ?>],
          ['Passager arrière millieu', <?= $etat_pers[4][1] ?>, <?= $etat_pers[4][0] ?>]

        ]);
        
        

        var options = {
          chart: {
            title: "Nombre de personnes impliqués/mortes dans un accident",
            subtitle: 'Sur <?php echo $iteration ?> itérations.',
          }
        };

        var chart = new google.charts.Bar(document.getElementById('columnchart_material'));

        chart.draw(data, google.charts.Bar.convertOptions(options));
      }

      function drawChart2() {
        var data = google.visualization.arrayToDataTable([
          ['Type de route', 'Taux de mortalié (%)'],

          ['Conducteur', <?= ($etat_pers[0][0]/$etat_pers[0][1])*100 ?>],
          ['Passager avant', <?= ($etat_pers[1][0]/$etat_pers[1][1])*100 ?>],
          ['Passager arrière droite', <?= ($etat_pers[2][0]/$etat_pers[2][1])*100 ?>],
          ['Passager arrière gauche', <?= ($etat_pers[3][0]/$etat_pers[3][1])*100 ?>],
          ['Passager arrière millieu', <?= ($etat_pers[4][0]/$etat_pers[4][1])*100 ?>]



        ]);

        var options = {
          chart: {
            title: 'Taux de mortalié (%) en fonction des places',
            subtitle: 'Sur <?php echo $iteration ?> itérations.',
          }
        };

        var chart2 = new google.charts.Bar(document.getElementById('columnchart_material2'));

        chart2.draw(data, google.charts.Bar.convertOptions(options));
      }
    </script>
  </head>
  <body>
    <div id="columnchart_material" style="width: 100%; height: 500px;"></div>
    <div id="columnchart_material2" style="width: 100%; height: 500px;"></div>
  </body>
</html>











<?php

  /*

foreach ($usagers as $item) {
    // Vérifie si l'ID de véhicule existe déjà dans le tableau $nb_pers
    if (!isset($nb_pers[$item['id_vehicule']])) {
        // Ajoute l'ID de véhicule au tableau $nb_pers avec une valeur de 1 pour la première personne
        $nb_pers[$item['id_vehicule']] = 1;
    } else {
        // Incrémente la valeur de l'ID de véhicule existant de 1 pour chaque personne supplémentaire
        $nb_pers[$item['id_vehicule']]++;
    }
}

// Affiche le nombre de personnes pour chaque ID de véhicule unique
//print_r($nb_pers);

// Initialisation du tableau pour stocker les ID de véhicules avec $nb_pers = 2
$vehicules_2_pers = [];

// Boucle pour parcourir le tableau $nb_pers
foreach ($nb_pers as $id_vehicule => $nb_personnes) {
// Vérifie si le nombre de personnes pour cet ID de véhicule est égal à 2
if ($nb_personnes == 2) {
// Ajoute l'ID de véhicule au tableau $vehicules_2_pers
$vehicules_2_pers[] = $id_vehicule;
}
}

// Initialisation du tableau pour stocker les places avec 'grav' = 3
$places_grav_3 = [];

// Boucle pour parcourir les données
foreach ($usagers as $item) {
// Vérifie si l'ID de véhicule courant est dans le tableau $vehicules_2_pers et si 'grav' = 3
if (in_array($item['id_vehicule'], $vehicules_2_pers) && $item['grav'] == 2) {
// Ajoute la place au tableau $places_grav_3
$places_grav_3[] = $item['place'];
}
}

// Affiche les ID de véhicules avec $nb_pers = 2
//print_r($vehicules_2_pers);

// Affiche les places avec 'grav' = 3 pour les ID de véhicules avec $nb_pers = 2
print_r($places_grav_3);
?>

*/

?>