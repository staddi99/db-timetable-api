<?php require_once('../list.php'); ?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="description" content="">
		<meta name="author" content="Maximilian Stadtmüller">
		<meta name="keywords" content="">
		<title>DB - Bahnhöfe</title>
	</head>	
	<body>
		<h1>DB - Bahnhöfe</h1>
		<ul>
<?php
for($i=65; $i<91; $i++)
{
	echo '			<h2>'.chr($i).'</h2>'."\r\n";
	foreach($loclist[chr($i)] as $list){echo '				<li><a target="_blank" href="?location='.$timetableAPI->getLocationName($list).'">'.$timetableAPI->getLocationName($list).'</a></li>'."\r\n";}
}
?>
		</ul>
	</body>
</html>