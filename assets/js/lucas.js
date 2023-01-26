
      google.charts.load('current', {'packages':['bar']});
      google.charts.setOnLoadCallback(drawChart);
      google.charts.setOnLoadCallback(drawChart2);

      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Type de route', 'Personnes impliqués dans un accident', 'Morts'],
          ['Autoroute', 1449, 19],
          ['Route nationale', 986, 37],
          ['Route Départementale', 3936, 185],
          ['Voie Communales', 4366, 64]

        ]);
        
        

        var options = {
          chart: {
            title: "Nombre de personnes impliqués/mortes dans un accident",
            subtitle: 'Sur 10000 itérations.',
          }
        };

        var chart = new google.charts.Bar(document.getElementById('columnchart_material'));

        chart.draw(data, google.charts.Bar.convertOptions(options));
      }

      function drawChart2() {
        var data = google.visualization.arrayToDataTable([
          ['Type de route', 'Taux de mortalié (%)'],
          ['Autoroute', 1.3112491373361],
          ['Route nationale', 3.7525354969574],
          ['Route Départementale', 4.7002032520325],


          ['Voie Communales', 1.4658726523133]

        ]);

        var options = {
          chart: {
            title: 'Taux de mortalié (%) en fonction des routes',
            subtitle: 'Sur 10000 itérations.',
          }
        };

        var chart2 = new google.charts.Bar(document.getElementById('columnchart_material2'));

        chart2.draw(data, google.charts.Bar.convertOptions(options));
      }
    