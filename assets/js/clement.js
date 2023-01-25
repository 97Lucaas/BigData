google.charts.load('current', {'packages':['bar']});
google.charts.setOnLoadCallback(drawChart);

function drawChart() {
  var data = google.visualization.arrayToDataTable([
    ['Nombre de personnes dans la voiture', 'Conducteur', 'Passager', 'Arrière conducteur', 'Arrière passager', 'Arrière milieu'],
    ['1', 1000, 0, 0, 0, 00],
    ['2', 765, 245, 68, 0, 0],
    ['3', 660, 1120, 300, 0, 0],
    ['4', 1030, 540, 350, 0, 0],
    ['5', 1030, 540, 350, 0, 500],
  ]);

  var options = {
    chart: {
      title: 'Quelle est la place du mort ?',
      subtitle: 'Nombre de morts par rapport à la place dans la voiture',
    },
    bars: 'vertical' // Required for Material Bar Charts.
  };

  var chart = new google.charts.Bar(document.getElementById('chart_div'));

  chart.draw(data, google.charts.Bar.convertOptions(options));
}