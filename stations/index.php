<?php
require_once('../api/timetable.class.php');
$timetableAPI = new timetable();
if(isset($_GET['location'])){$station = $timetableAPI->getLocationName($_GET['location']); include('station.php');}else{include('list.php');}
?>
