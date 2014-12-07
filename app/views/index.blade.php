<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Barclays beautification</title>
    <link href="{{ URL::asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('css/style.css') }}">
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body> 
    <div class="container demo-2">
      <div class="content">
          <div id="large-header" class="large-header">
              <canvas id="demo-canvas"></canvas>
              <div class="container">
                  <div class="logo main-title">
                    <img src="{{ URL::asset('images/barclays.png') }}"  />
                  </div> 
              </div>
        </div>
      </div>
    </div>
	 <div class="container default">
	 </div>
   <div class="container">
       <h2>Host types </h2>
       <div id="piechart"></div>
    </div>
	<div class="container">
     <h2>Operational systems</h2>
	   <div id="piechart2"></div>
	</div>
  <div class="container">
    <h2>Application types</h2>
    <div class="col-xs-12">
            <?php
             $tableType = DB::table('table 1')->distinct()->lists('HostType');
              foreach ($tableType as $key) {
                echo '<div class="col-xs-4">'.$key. '</div>';
              }
             ?>
    </div>
  </div>
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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="http://d3js.org/d3.v3.min.js" charset="utf-8"></script>
    <script src="{{ URL::asset('js/rAF.js') }}"></script>
    <script src="{{ URL::asset('js/demo-2.js') }}"></script>
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
  		  ['Disaster recovery',  dr],
        ]);
        var options = {};
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
	 </script>
  </body>
</html>