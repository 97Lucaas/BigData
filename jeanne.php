<?php

error_reporting(E_ERROR | E_PARSE);

$lieux = json_decode(file_get_contents("assets/data/lieux-2021.json"),true);
$carac = json_decode(file_get_contents("assets/data/carcteristiques-2021.json"),true); //
$usagers = json_decode(file_get_contents("assets/data/usagers-2021.json"),true); //
$vehicules = json_decode(file_get_contents("assets/data/vehicules-2021.json"),true);

function array_insert(&$array, $position, $insert)
{
    if (is_int($position)) {
        array_splice($array, $position, 0, $insert);
    } else {
        $pos   = array_search($position, array_keys($array));
        $array = array_merge(
            array_slice($array, 0, $pos),
            $insert,
            array_slice($array, $pos)
        );
    }
}

//$tab_des_h = array(1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23);
$tab_des_h = array(
  //array("nb de mort","nb de vivnt"), //ID = 0, heure = 0
  array(0,0),
  array(0,0),// 1 heure
  array(0,0),
  array(0,0),
  array(0,0),
  array(0,0),
  array(0,0),
  array(0,0),
  array(0,0),
  array(0,0),
  array(0,0),
  array(0,0),
  array(0,0),
  array(0,0),
  array(0,0),
  array(0,0),
  array(0,0),
  array(0,0),
  array(0,0),
  array(0,0),
  array(0,0),
  array(0,0),
  array(0,0),
  array(0,0) //23 h
);


$mort = 0;
$non_mort = 0;
$depart = 0;
$iteration = 20000;

for($e = $depart; $e < $iteration; $e++){ //caractéristiques

  for($i = $depart; $i < $iteration*2; $i++){ //usagers

      if($carac[$e]['Num_Acc'] == $usagers[$i]['Num_Acc']){

        (int)$tabhmmn = explode(":", $carac[$e]['hrmn']);

        //var_dump((int)$tabhmmn[0]);

        /*

        - array
          - "0"
            - "0" => nb de morts
            - "1" => nb de vivants
          - "1"
            - "0" => nb de morts
            - "1" => nb de vivants

          ...

          - "23"
            - "0" => nb de morts
            - "1" => nb de vivants

        */
        //var_dump($tab_des_h[(int)$tabhmmn[0]][0]);

        //array_splice( $tab_des_h, 0, 0, "jajj" );

        //array_insert($tab_des_h, 0, array(9,0));

        if($usagers[$i]['grav'] == 2){
          $tab_des_h[(int)$tabhmmn[0]][0] = $tab_des_h[(int)$tabhmmn[0]][0] + 1; //add 1 aux morts
          //array_splice( $tab_des_h[(int)$tabhmmn[0]], 0, 0, $tab_des_h[(int)$tabhmmn[0]][0] + 1 );
          //array_insert($tab_des_h[(int)$tabhmmn[0]], 0, 9);
        }else{
          $tab_des_h[(int)$tabhmmn[0]][1] = $tab_des_h[(int)$tabhmmn[0]][1] + 1; //add 1 aux vivants
          //array_splice( $tab_des_h[(int)$tabhmmn[0]], 1, 0, $tab_des_h[(int)$tabhmmn[0]][0] + 1 );
        }

  }

  $i++;

}
}


//var_dump($tab_des_h);

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
          <script type="text/javascript">
            google.charts.load('current', {'packages':['corechart']});
            google.charts.setOnLoadCallback(drawChart);
      
            function drawChart() {
              var data = google.visualization.arrayToDataTable([
                ['Heure Accident', 'Accidents', 'Accidents mortels'],

                <?php
                  for($e = 0; $e < count($tab_des_h); $e++){
                ?>

                [<?= $e ?>, <?= $tab_des_h[$e][1] ?>, <?= $tab_des_h[$e][0] ?>],

                <?php
                }
                ?>



              ]);
      
              var options = {
                hAxis: {
                  title: 'Heures de la journée'
                },
                vAxis: {
                  title: "Nombre d'Accidents / d'Accidents Mortels"
                },
                title: 'Les heures auxquelles les accidents et les accidents mortels sont plus importants.',
                curveType: 'function',
                legend: { position: 'bottom' }
                
              };
      
              var chart = new google.visualization.LineChart(document.getElementById('curve_chart'));
      
              chart.draw(data, options);
            }
          </script>
      
    
</head>
<body>
    <div id="curve_chart" style="width: 1500px; height: 620px"></div>
    <p><b>Sources :</b></br>data.gouv.fr -> <a href="https://www.data.gouv.fr/fr/datasets/bases-de-donnees-annuelles-des-accidents-corporels-de-la-circulation-routiere-annees-de-2005-a-2021/#resourceshttps://www.data.gouv.fr/fr/datasets/bases-de-donnees-annuelles-des-accidents-corporels-de-la-circulation-routiere-annees-de-2005-a-2021/#resources" target="_blank">Bases de données annuelles des accidents corporels de la circulation routière.</a >
    </br></br>Période des données utilisées : année 2021</p>
</body>
</html>