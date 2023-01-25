<?php

$lieux = file_get_contents("assets/data/lieux-2021.json");
$carac = file_get_contents("assets/data/carcteristiques-2021.json");
$usagers = json_decode(file_get_contents("assets/data/usagers-2021.json"),true);
$vehicules = file_get_contents("assets/data/vehicules-2021.json");


//var_dump($usagers[0]['grav']);
foreach($usagers as $item) { //foreach element in $arr

  if($item['grav'] == 2){
    $count_mort++;
  }
  elseif($item['grav'] == 3){
    $count_hosp++;
  }
  elseif($item['grav'] == 4){
    $count_leger++;
  }
  elseif($item['grav'] == 1){
    $count_indemne++;
  }
  
}

?>

<html>
  <head>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {

        var data = google.visualization.arrayToDataTable([
          ['Task', 'Hours per Day'],
          ['Mort',     <?php echo $count_mort; ?>],
          ['Indemne',     <?php echo $count_indemne; ?>],
          ['Blessé léger',     <?php echo $count_leger; ?>],
          ['Blessé hospitalisé',     <?php echo $count_hosp; ?>]
        ]);

        var options = {
          title: 'My Daily Activities'
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart'));

        chart.draw(data, options);
      }
    </script>
  </head>
  <body>
    <div id="piechart" style="width: 900px; height: 500px;"></div>
  </body>
</html>
