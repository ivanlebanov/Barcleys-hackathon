      google.setOnLoadCallback(drawChart);
      function drawChart() {

        var data = google.visualization.arrayToDataTable([
          ['Task', 'Hours per Day'],
          ['Windows',     6],
          ['iOS',      8],
          ['Linux',  7],
  
        ]);

        var options = {
          title: 'Compared OS usage'
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart'));

        chart.draw(data, options);
    
    }