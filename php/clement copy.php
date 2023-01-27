<?php

error_reporting(E_ERROR | E_PARSE);

//$lieux = json_decode(file_get_contents("assets/data/lieux-2021.json"),true);
//$carac = json_decode(file_get_contents("assets/data/carcteristiques-2021.json"),true);
$data_usagers = json_decode(file_get_contents("assets/data/usagers-2021.json"),true);
//$vehicules = json_decode(file_get_contents("assets/data/vehicules-2021.json"),true);

$individus = array_map(function($ligne) {
  return array("place" => $ligne["place"], "grav" => $ligne["grav"]);
}, $data_usagers);

//var_dump ($individus);


$etat_pers = array(
    array(0,0), //place du conducteur ID = 0, mort ou vivant
    array(0,0), //place du passagers avant
    array(0,0), //place du passagers arrière droite
    array(0,0), //place du passagers arrière gauche
    array(0,0) //place du passagers arrière millieu
  );

  $depart = 0;
  //$iteration = 1000000;

  $iteration = count($individus);


for ($i=$depart; $i < $iteration; $i++) { 
    

    if($individus[$i]['grav'] == 2){

        $etat_pers[$individus[$i]['place']-1][0] = $etat_pers[$individus[$i]['place']-1][0] + 1;

    }else{

        $etat_pers[$individus[$i]['place']-1][1] = $etat_pers[$individus[$i]['place']-1][1] + 1;

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
           // height: 50%,    
          //  width: 100%,
          },
         // hAxis: {scaleType: 'log'},
        };

        var chart = new google.charts.Bar(document.getElementById('columnchart_material'));

        chart.draw(data, google.charts.Bar.convertOptions(options));
      }

      function drawChart2() {
        var data = google.visualization.arrayToDataTable([
          ['Type de route', 'Taux de mortalié (%)'],

          ['Conducteur', <?= ($etat_pers[0][0]/$etat_pers[0][1])*100 ?>],
          ['place du passager avant', <?= ($etat_pers[1][0]/$etat_pers[1][1])*100 ?>],
          ['place du passager arrière droite', <?= ($etat_pers[2][0]/$etat_pers[2][1])*100 ?>],
          ['place du passager arrière gauche', <?= ($etat_pers[3][0]/$etat_pers[3][1])*100 ?>],
          ['place du passager arrière millieu', <?= ($etat_pers[4][0]/$etat_pers[4][1])*100 ?>]

        ]);

        var options = {
          chart: {title: 'Taux de mortalié (%) en fonction des places', subtitle: 'Sur <?php echo $iteration ?> itérations.',}
          //width: 600,
         // width: 100%,
          //bar: {groupWidth: "95%"},
        };

        var chart2 = new google.charts.Bar(document.getElementById('columnchart_material2'));

        chart2.draw(data, google.charts.Bar.convertOptions(options));
      }
    </script>
  </head>
  <body>
      <div id="columnchart_material" style="width: 100%; height: 50%;"></div>
      <div id="columnchart_material2" style="width: 100%; height: 50%;"></div>
  </body>
</html>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=<device-width>, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <div style="background-color: blueviolet;">coucou</div>
</body>
</html>