<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Barclays</title>

    <!-- Bootstrap -->
    <link href="{{ URL::asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('css/style.css') }}">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body> 

    <header> <div class="container">
  <div class="logo"><img src="{{ URL::asset('images/barclays.png') }}" />
  </div> 
  </div>
  </header>
 
   <div class="container">
       <div id="piechart" style="width: 900px; height: 500px;"></div>
    </div>
	<div class="container">
	   <div id="piechart2" style="width: 900px; height: 500px;"></div>
	</div>
	<div class="welcome">
	<?php $table = DB::table('table 1')->get();
		$dev = 0;
		$UNCLASSIFIED = 0;
		$prod = 0;
		$sit = 0;
		$uat = 0;
		$dr = 0;
		foreach ($table as $server)
		{ 
			if ($server->Name == "DEV" ){
				$dev++;
			}elseif ($server->Name == "UNCLASSIFIED"){
				$UNCLASSIFIED++;
			}
			elseif ($server->Name == "PROD"){
				$prod++;
			}
			elseif ($server->Name == "SIT"){
				$sit++;
			}
			elseif ($server->Name == "UAT"){
				$uat++;
			}
			else{
				$dr++;
			}
		}?>

	<?php
		$linux = 0;
		$windows = 0;
		$AIX = 0;
		 $table2 = DB::table('table 1')->get();
		foreach ($table2 as $os)
		{ 
			if (strpos($os->Ip ,'Linux') !== false) {
				$linux++;
			}elseif (strpos($os->Ip ,'Windows') !== false){
				$windows++;
			}
			else{
				$AIX++;
			}
		}?>
 <script type="text/javascript" src="https://www.google.com/jsapi?autoload={'modules':[{'name':'visualization','version':'1','packages':['corechart']}]}"></script>
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="{{ URL::asset('js/bootstrap.min.js') }}"></script>
	<script>
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
  		  ['Disaster recovory',  dr],
        ]);

        var options = {
          title: 'Comparision of host type'
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart'));

        chart.draw(data, options);
 

        var data2 = google.visualization.arrayToDataTable([
          ['Task', 'Comparision of operation systems'],
          ['Linux',     linux],
          ['Windows',      windows],
          ['AIX',  AIX],
        ]);

        var options2 = {
          title: 'Comparision of operation systems'
        };

        var chart2 = new google.visualization.PieChart(document.getElementById('piechart2'));

        chart2.draw(data2, options2);
    
    }
	</script>
    <script src="http://d3js.org/d3.v3.min.js" charset="utf-8"></script>
  </body>
</html>