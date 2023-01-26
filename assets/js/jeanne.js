
            google.charts.load('current', {'packages':['corechart']});
            google.charts.setOnLoadCallback(drawChart);
      
            function drawChart() {
              var data = google.visualization.arrayToDataTable([
                ['Heure Accident', 'Accidents', 'Accidents mortels'],

                
                [0, 338, 14],

                
                [1, 286, 14],

                
                [2, 233, 14],

                
                [3, 187, 13],

                
                [4, 183, 12],

                
                [5, 265, 16],

                
                [6, 403, 14],

                
                [7, 967, 23],

                
                [8, 1153, 22],

                
                [9, 865, 19],

                
                [10, 800, 25],

                
                [11, 945, 21],

                
                [12, 1004, 15],

                
                [13, 1004, 15],

                
                [14, 1107, 25],

                
                [15, 1118, 37],

                
                [16, 1397, 35],

                
                [17, 1830, 37],

                
                [18, 1728, 34],

                
                [19, 1326, 33],

                
                [20, 844, 20],

                
                [21, 632, 26],

                
                [22, 432, 18],

                
                [23, 437, 14],

                


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
          