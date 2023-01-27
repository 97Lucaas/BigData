
      google.charts.load('current', {'packages':['bar']});
      google.charts.setOnLoadCallback(drawChart);
      google.charts.setOnLoadCallback(drawChart2);

      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Place', 'Vivants', 'Morts'],
          ['Conducteur', 94736, 2290],
          ['Passager avant', 14159, 293],
          ['Passager arrière droite', 2428, 46],
          ['Passager arrière gauche', 2191, 37],
          ['Passager arrière millieu', 593, 17]

        ]);
        
        

        var options = {
          chart: {
            title: "Nombre de personnes impliqués/mortes dans un accident",
            subtitle: 'Sur 129153 itérations.',
          }
        };

        var chart = new google.charts.Bar(document.getElementById('columnchart_material'));

        chart.draw(data, google.charts.Bar.convertOptions(options));
      }

      function drawChart2() {
        var data = google.visualization.arrayToDataTable([
          ['Type de route', 'Taux de mortalié (%)'],

          ['Conducteur', 2.417243708833],
          ['Passager avant', 2.0693551804506],
          ['Passager arrière droite', 1.8945634266886],
          ['Passager arrière gauche', 1.6887266088544],
          ['Passager arrière millieu', 2.8667790893761]



        ]);

        var options = {
          chart: {
            title: 'Taux de mortalié (%) en fonction des places',
            subtitle: 'Sur 129153 itérations.',
          }
        };

        var chart2 = new google.charts.Bar(document.getElementById('columnchart_material2'));

        chart2.draw(data, google.charts.Bar.convertOptions(options));
      }
    