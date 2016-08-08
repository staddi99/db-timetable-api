<?php
require_once('settings.php');

class timetable{
	function getLocation($location){
		$location = str_replace(' ', '+', $location);
		$url = BASE_URL."/location.name?authKey=".AUTH_KEY."&lang=".LANG."&format=".FORMAT."&input=".$location;
		$ch = curl_init();
		curl_setopt($ch,CURLOPT_URL,$url);
		curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
		curl_setopt($ch,CURLOPT_CONNECTTIMEOUT, 4);
		$json = curl_exec($ch);
		if(!$json) {
			echo curl_error($ch);
		}
		curl_close($ch);
		$xml = json_decode($json, true);
		return $xml['LocationList']['StopLocation']['0'];
	}

	function getLocationName($location){
		$location = $this->getLocation($location);
		return $location['name'];
	}
	
	function getLocationPos($location){
		$location = $this->getLocation($location);
		return array('lon' => $location['lon'], 'lat' => $location['lat']);
	}
	
	function getLocationID($location){
		$location = $this->getLocation($location);
		return $location['id'];
	}
	
	function getDeparture($location,$date,$time){
		$id = $this->getLocationID($location);
		$now = getdate();
		if(!$date){$date = $now['year']."-".$now['mon']."-".$now['mday'];}else{$date = $date;}
		if(!$time){$time = $now['hours'].":".$now['minutes'];}else{$time = $time;}
		$url = BASE_URL."/departureBoard?authKey=".AUTH_KEY."&lang=".LANG."&format=".FORMAT."&id=".$id."&date=".$date."&time=".$time;
		$ch = curl_init();
		curl_setopt($ch,CURLOPT_URL,$url);
		curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
		curl_setopt($ch,CURLOPT_CONNECTTIMEOUT, 4);
		$json = curl_exec($ch);
		if(!$json) {
			echo curl_error($ch);
		}
		curl_close($ch);
		$xml = json_decode($json, true);
		return $xml['DepartureBoard']['Departure'];
	}
	
	function getNextDeparture($location){
		$departure = $this->getDeparture($location);
		return $departure['0'];
	}
	
	function getNextDepartureName($location){
		$departure = $this->getNextDeparture($location);
		return $departure['name'];
	}
	
	function getNextDepartureType($location){
		$departure = $this->getNextDeparture($location);
		return $departure['type'];
	}
	
	function getNextDepartureStopID($location){
		$departure = $this->getNextDeparture($location);
		return $departure['stopid'];
	}
	
	function getNextDepartureStop($location){
		$departure = $this->getNextDeparture($location);
		return $departure['stop'];
	}
	
	function getNextDepartureTime($location){
		$departure = $this->getNextDeparture($location);
		return $departure['time'];
	}
	
	function getNextDepartureDate($location){
		$departure = $this->getNextDeparture($location);
		return $departure['date'];
	}
	
	function getNextDepartureDirection($location){
		$departure = $this->getNextDeparture($location);
		return $departure['direction'];
	}
	
	function getNextDepartureTrack($location){
		$departure = $this->getNextDeparture($location);
		return $departure['track'];
	}
	
	function getNextDepartureJourneyDetailRef($location){
		$departure = $this->getNextDeparture($location);
		return $departure['JourneyDetailRef']['ref'];
	}
	
	function getArrival($location,$date,$time){
		$id = $this->getLocationID($location);
		$now = getdate();
		if(!$date){$date = $now['year']."-".$now['mon']."-".$now['mday'];}else{$date = $date;}
		if(!$time){$time = $now['hours'].":".$now['minutes'];}else{$time = $time;}
		$url = BASE_URL."/arrivalBoard?authKey=".AUTH_KEY."&lang=".LANG."&format=".FORMAT."&id=".$id."&date=".$date."&time=".$time;
		$ch = curl_init();
		curl_setopt($ch,CURLOPT_URL,$url);
		curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
		curl_setopt($ch,CURLOPT_CONNECTTIMEOUT, 4);
		$json = curl_exec($ch);
		if(!$json) {
			echo curl_error($ch);
		}
		curl_close($ch);
		$xml = json_decode($json, true);
		return $xml['ArrivalBoard']['Arrival'];
	}
	
	function getNextArrival($location){
		$arrival = $this->getArrival($location);
		return $arrival['0'];
	}
	
	function getNextArrivalName($location){
		$arrival = $this->getNextArrival($location);
		return $arrival['name'];
	}
	
	function getNextArrivalType($location){
		$arrival = $this->getNextArrival($location);
		return $arrival['type'];
	}
	
	function getNextArrivalStopID($location){
		$arrival = $this->getNextArrival($location);
		return $arrival['stopid'];
	}
	
	function getNextArrivalStop($location){
		$arrival = $this->getNextArrival($location);
		return $arrival['stop'];
	}
	
	function getNextArrivalTime($location){
		$arrival = $this->getNextArrival($location);
		return $arrival['time'];
	}
	
	function getNextArrivalDate($location){
		$arrival = $this->getNextArrival($location);
		return $arrival['date'];
	}
	
	function getNextArrivalOrigin($location){
		$arrival = $this->getNextArrival($location);
		return $arrival['origin'];
	}
	
	function getNextArrivalTrack($location){
		$arrival = $this->getNextArrival($location);
		return $arrival['track'];
	}
	
	function getNextArrivalJourneyDetailRef($location){
		$arrival = $this->getNextArrival($location);
		return $arrival['JourneyDetailRef']['ref'];
	}
	
	function getJourney($ref){
		$url = BASE_URL."/journeyDetail?authKey=".AUTH_KEY."&lang=".LANG."&format=".FORMAT."&ref=".$ref;
		$ch = curl_init();
		curl_setopt($ch,CURLOPT_URL,$url);
		curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
		curl_setopt($ch,CURLOPT_CONNECTTIMEOUT, 4);
		$json = curl_exec($ch);
		if(!$json) {
			echo curl_error($ch);
		}
		curl_close($ch);
		$xml = json_decode($json, true);
		return $xml['JourneyDetail'];
	}
	
	function getJourneyStops($ref){
		$journey = $this->getJourney($ref);
		return $journey['Stops']['Stop'];
	}
	
	function getJourneyStop($ref,$stop){
		$journey = $this->getJourney($ref);
		return $journey['Stops']['Stop'][$stop];
	}
	
	function getJourneyStopName($ref,$stop){
		$journey = $this->getJourneyStop($ref,$stop);
		return $journey['name'];
	}
	
	function getJourneyStopID($ref,$stop){
		$journey = $this->getJourneyStop($ref,$stop);
		return $journey['id'];
	}
	
	function getJourneyStopPos($ref,$stop){
		$journey = $this->getJourneyStop($ref,$stop);
		return array("lon" => $journey['lon'], "lat" => $journey['lat']);
	}
	
	function getJourneyStopRouteIdx($ref,$stop){
		$journey = $this->getJourneyStop($ref,$stop);
		return $journey['routeIdx'];
	}
	
	function getJourneyStopArrTime($ref,$stop){
		$journey = $this->getJourneyStop($ref,$stop);
		return $journey['arrTime'];
	}
	
	function getJourneyStopArrDate($ref,$stop){
		$journey = $this->getJourneyStop($ref,$stop);
		return $journey['arrDate'];
	}
	
	function getJourneyStopDepTime($ref,$stop){
		$journey = $this->getJourneyStop($ref,$stop);
		return $journey['depTime'];
	}
	
	function getJourneyStopDepDate($ref,$stop){
		$journey = $this->getJourneyStop($ref,$stop);
		return $journey['depDate'];
	}
	
	function getJourneyStopTrack($ref,$stop){
		$journey = $this->getJourneyStop($ref,$stop);
		return $journey['track'];
	}
	
	function getJourneyName($ref){
		$journey = $this->getJourney($ref);
		return $journey['Names']['Name']['name'];
	}
	
	function getJourneyType($ref){
		$journey = $this->getJourney($ref);
		return $journey['Types']['Type']['type'];
	}
	
	function getJourneyOperator($ref){
		$journey = $this->getJourney($ref);
		return $journey['Operators']['Operator']['name'];
	}
	
	function getJourneyNotes($ref){
		$journey = $this->getJourney($ref);
		return $journey['Notes']['Note'];
	}
	
	function getJourneyNote($ref){
		$journey = $this->getJourneyNotes($ref);
		return $journey["$"];
	}
}
?>