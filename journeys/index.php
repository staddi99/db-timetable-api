<?php
require_once('../api/timetable.class.php');
$timetableAPI = new timetable();
if(isset($_GET['ref'])){$ref = $_GET['ref'];}else{header('Location: /stations/');}
$journeyname = $timetableAPI->getJourneyName($ref);
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="description" content="">
		<meta name="author" content="Maximilian Stadtmüller">
		<meta name="keywords" content="">
		<title>DB - <?php echo $journeyname; ?></title>
		
		<link rel="stylesheet" type="text/css" media="screen" href="../css/style.css" />
	</head>	
	<body>
		<h1>DB - Fahrplan-API</h1>
		<div class="table"><div class="row"><div class="cell"><h2><?php echo $journeyname; ?></h2></div><!--<div class="cell"><a href="./">Zurück zur Übersicht</a></div>--></div></div>
		
		<h3>Fahrplan</h3>
		<div class="table default">
			<div class="row head">
				<div class="cell">Halt Nr.</div>
				<div class="cell">Bahnhof</div>
				<div class="cell">Gleis</div>
				<div class="cell">Ankunftsdatum</div>
				<div class="cell">Ankunftszeit</div>
				<div class="cell">Abfahrtsdatum</div>
				<div class="cell">Abfahrtszeit</div>
				<div class="cell">Google Maps</div>
			</div>
<?php
$stops = $timetableAPI->getJourneyStops($ref);
foreach ($stops as $stop)
{
	echo '            <div class="row">'."\r\n";
	echo '                <div class="cell">'.(intval($stop['routeIdx'])+1).'</div>'."\r\n";
	echo '                <div class="cell"><a title="'.$stop['id'].'" target="_blank" href="/stations?location='.str_replace(" ","+",$stop['name']).'">'.$stop['name'].'</a></div>'."\r\n";
	echo '                <div class="cell">'.$stop['track'].'</div>'."\r\n";
	echo '                <div class="cell">';if(date("m.d.Y",strtotime($stop['arrDate']))=="01.01.1970"){echo "";}else{echo date("m.d.Y",strtotime($stop['arrDate']));}echo '</div>'."\r\n";
	echo '                <div class="cell">'.$stop['arrTime'].'</div>'."\r\n";
	echo '                <div class="cell">';if(date("m.d.Y",strtotime($stop['depDate']))=="01.01.1970"){echo "";}else{echo date("m.d.Y",strtotime($stop['depDate']));}echo '</div>'."\r\n";
	echo '                <div class="cell">'.$stop['depTime'].'</div>'."\r\n";
	echo '                <div class="cell"><a target="_blank" href="https://maps.google.de/maps?q='.$stop['lat'].','.$stop['lon'].'('.str_replace(" ","+",$stop['name']).')&t=k&z=19">Auf Karte anzeigen</a></div>'."\r\n";
	echo '            </div>'."\r\n";
}
?>
		</div>
	</body>
</html>