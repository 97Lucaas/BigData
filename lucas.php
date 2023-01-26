

<?php

error_reporting(E_ERROR | E_PARSE);

$lieux = json_decode(file_get_contents("assets/data/lieux-2021.json"),true);
$carac = json_decode(file_get_contents("assets/data/carcteristiques-2021.json"),true);
$usagers = json_decode(file_get_contents("assets/data/usagers-2021.json"),true);
$vehicules = json_decode(file_get_contents("assets/data/vehicules-2021.json"),true);


//var_dump($usagers[56]);
//var_dump($lieux[56]);

$autoroute = 0;
$m_autoroute = 0;
$m_nationale = 0;
$nationale = 0;
$m_departementale = 0;
$departementale = 0;
$m_communales = 0;
$communales = 0;


$depart = 0;
$iteration = 1000;

for($e = $depart; $e < $iteration; $e++){ //lieux

            for($i = $depart; $i < $iteration*2; $i++){

                if($lieux[$e]['Num_Acc'] == $usagers[$i]['Num_Acc']){

                switch ($lieux[$e]['catr']) {
                    case 1:
                        if($usagers[$i]['grav'] == 2){
                            $m_autoroute++;
                        }
                        $autoroute++;
                        break;
                    case 2:
                        if($usagers[$i]['grav'] == 2){
                            $m_nationale++;
                        }
                        $nationale++;
                        break;
                    case 3:
                        if($usagers[$i]['grav'] == 2){
                            $m_departementale++;
                        }
                        $departementale++;
                        break;
                    case 4:
                        if($usagers[$i]['grav'] == 2){
                            $m_communales++;
                        }
                        $communales++;
                        break;
                    //case 5:
                        //if($item['grav'] == 2){
                        //    $m_hors_res_publ++;
                        //}else{
                        //    $hors_res_publ++;
                        //}
                        //break;
                    //case 6:
                        //if($item['grav'] == 2){
                        //    $m_parc_stationnement++;
                        //}else{
                        //    $parc_stationnement++;
                        //}
                        //break;
                    //case 7:
                        //if($item['grav'] == 2){
                        //    $m_rout_metro_urb++;
                        //}else{
                        //    $rout_metro_urb++;
                        //}
                        //break;
                    //case 9:
                        //if($item['grav'] == 2){
                        //    $m_autre++;
                        //}else{
                        //    $autre++;
                        //}
                        //break;
                    
                    default:
                            break;
                        break;
                }

                $i++;

            }
    }

    }


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
          ['Type de route', 'Personnes impliqués dans un accident', 'Morts'],
          ['Autoroute', <?= $autoroute ?>, <?= $m_autoroute ?>],
          ['Route nationale', <?= $nationale ?>, <?= $m_nationale ?>],
          ['Route Départementale', <?= $departementale ?>, <?= $m_departementale ?>],

          ['Voie Communales', <?= $communales ?>, <?= $m_communales ?>]

        ]);
        
        

        var options = {
          chart: {
            title: 'Company Performance',
            subtitle: 'Sales, Expenses, and Profit: 2014-2017',
          }
        };

        var chart = new google.charts.Bar(document.getElementById('columnchart_material'));

        chart.draw(data, google.charts.Bar.convertOptions(options));
      }

      function drawChart2() {
        var data = google.visualization.arrayToDataTable([
          ['Type de route', 'Taux de mortalié (%)'],
          ['Autoroute', <?php if($autoroute == 0 OR ($m_autoroute/$autoroute)*100 == NAN){ echo 0; }else{ echo ($m_autoroute/$autoroute)*100; } ?>],
          ['Route nationale', <?php if($nationale == 0 OR ($m_nationale/$nationale)*100 == NAN){ echo 0; }else{ echo ($m_nationale/$nationale)*100; } ?>],
          ['Route Départementale', <?php if($departementale == 0 OR ($m_departementale/$departementale)*100 == NAN){ echo 0; }else{ echo ($m_departementale/$departementale)*100; } ?>],


          ['Voie Communales', <?php if($communales == 0 OR ($m_communales/$communales)*100 == NAN){ echo 0; }else{ echo ($m_communales/$communales)*100; } ?>]

        ]);

        var options = {
          chart: {
            title: 'Company Performance',
            subtitle: 'Sales, Expenses, and Profit: 2014-2017',
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
