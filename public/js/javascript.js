  var dev = <?php echo json_encode($dev); ?>;
    var UNCLASSIFIED = <?php echo json_encode($UNCLASSIFIED); ?>;
    var prod = <?php echo json_encode($prod); ?>;
    var sit = <?php echo json_encode($sit); ?>;
    var uat = <?php echo json_encode($uat); ?>;
    var dr = <?php echo json_encode($dr); ?>;
    var linux = <?php echo json_encode($linux); ?>;
    var windows = <?php echo json_encode($windows); ?>;
    var AIX = <?php echo json_encode($AIX); ?>;
          google.setOnLoadCallback(drawChart);
      function drawChart() {

        var data = google.visualization.arrayToDataTable([
          ['Task', 'Comparision of host type'],
          ['Development',     dev],
          ['Unclasified',      UNCLASSIFIED],
          ['Production',  prod],
        ['System Integration testing',  sit],
        ['User Acceptance testing',  uat],
        ['Disaster recovery',  dr],
        ]);
        var options = {          
        };
        var chart = new google.visualization.PieChart(document.getElementById('piechart'));
        chart.draw(data, options);
        var data2 = google.visualization.arrayToDataTable([
          ['Task', 'Comparision of operation systems'],
          ['Linux',     linux],
          ['Windows',      windows],
          ['AIX',  AIX],
        ]);
        var options2 = {};
        var chart2 = new google.visualization.PieChart(document.getElementById('piechart2'));
        chart2.draw(data2, options2);
    }
    