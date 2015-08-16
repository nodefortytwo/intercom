<?php
function process_data($resource){
	$customers_in_range = [];
	$line_number = 0;

	while($line = fgets($resource)){
		$line_number++;
		

		$customer = json_decode($line);
		if(!$customer){
			echo "Unable to parse record on line $line_number\n";
			continue;
		}

		//check distance
		$distance = calculate_distance($_ENV['office_lat'],
										 $_ENV['office_lng'], 
										 $customer->latitude, 
										 $customer->longitude);
		if($distance < 100){
			//add customer to list
			$customer->distance = $distance;
			$customers_in_range[$customer->user_id] = $customer;
		}
	}

	return $customers_in_range;
}

function calculate_distance($first_lat, $first_lng, $second_lat, $second_lng){
	$first_lat = (float) $first_lat;
	$first_lng = (float) $first_lng;
	$second_lat = (float) $second_lat;
	$second_lng = (float) $second_lng;

	$theta = $first_lng - $second_lng;
	$dist = sin(deg2rad($first_lat)) * sin(deg2rad($second_lat)) + cos(deg2rad($first_lat)) * cos(deg2rad($second_lat)) * cos(deg2rad($theta));
	$dist = acos($dist);
	$dist = rad2deg($dist);
	$dist = $dist * 111.32;

	return round($dist, 2);
}