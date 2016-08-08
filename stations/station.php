<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="description" content="">
		<meta name="author" content="Maximilian Stadtmüller">
		<meta name="keywords" content="">
		<title>DB - <?php echo $station; ?></title>
		
		<link rel="stylesheet" type="text/css" media="screen" href="../css/style.css" />
	</head>	
	<body>
		<h1>DB - Fahrplan-API</h1>
		<div class="table"><div class="row"><div class="cell"><h2><?php echo $station; ?></h2></div><div class="cell"><a href="./">Zurück zur Übersicht</a></div></div></div>
		
		<h3>Ankunft</h3>
		<div class="table default">
			<div class="row head">
				<div class="cell">Zug</div>
				<div class="cell">Typ</div>
				<div class="cell">Von</div>
				<div class="cell">Ankunftsdatum</div>
				<div class="cell">Ankunftszeit</div>
				<div class="cell">Gleis</div>
				<div class="cell">Fahrtdetails</div>
			</div>
<?php
$arrivals = $timetableAPI->getArrival($station);
foreach ($arrivals as $arrival)
{
	echo '            <div class="row">'."\r\n";
	echo '                <div class="cell">'.$arrival['name'].'</div>'."\r\n";
	echo '                <div class="cell">'.$arrival['type'].'</div>'."\r\n";
	echo '                <div class="cell">'.$arrival['origin'].'</div>'."\r\n";
	echo '                <div class="cell">';if(date("m.d.Y",strtotime($arrival['date']))=="01.01.1970"){echo "";}else{echo date("m.d.Y",strtotime($arrival['date']));}echo '</div>'."\r\n";
	echo '                <div class="cell">'.$arrival['time'].'</div>'."\r\n";
	echo '                <div class="cell">'.$arrival['track'].'</div>'."\r\n";
	echo '                <div class="cell"><a target="_blank" href="/journeys?ref='.str_replace("https://open-api.bahn.de/bin/rest.exe/v1.0/journeyDetail?ref=","",$arrival['JourneyDetailRef']['ref']).'">Fahrtdetails</a></div>'."\r\n";
	echo '            </div>'."\r\n";
}
?>
		</div>
		
		<h3>Abfahrt</h3>
		<div class="table default">
			<div class="row head">
				<div class="cell">Zug</div>
				<div class="cell">Typ</div>
				<div class="cell">Nach</div>
				<div class="cell">Abfahrtsdatum</div>
				<div class="cell">Abfahrtszeit</div>
				<div class="cell">Gleis</div>
				<div class="cell">Fahrtdetails</div>
			</div>
<?php
$departures = $timetableAPI->getDeparture($station);
foreach ($departures as $departure)
{
	echo '            <div class="row">'."\r\n";
	echo '                <div class="cell">'.$departure['name'].'</div>'."\r\n";
	echo '                <div class="cell">'.$departure['type'].'</div>'."\r\n";
	echo '                <div class="cell">'.$departure['direction'].'</div>'."\r\n";
	echo '                <div class="cell">';if(date("m.d.Y",strtotime($departure['date']))=="01.01.1970"){echo "";}else{echo date("m.d.Y",strtotime($departure['date']));}echo '</div>'."\r\n";
	echo '                <div class="cell">'.$departure['time'].'</div>'."\r\n";
	echo '                <div class="cell">'.$departure['track'].'</div>'."\r\n";
	echo '                <div class="cell"><a href="'.$departure['JourneyDetailRef']['ref'].'">Fahrtdetails</a></div>'."\r\n";
	echo '            </div>'."\r\n";
}
?>
		</div>
	</body>
</html>