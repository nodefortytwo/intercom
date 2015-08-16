<?php

//flatten nested array

function flatten_array($array){

	if(!is_array($array)){
		throw new Exception('Argument 1 must be an array');
	}


	$output_array = [];

	foreach($array as $value){
		if(is_array($value)){
			$output_array = array_merge($output_array, flatten_array($value));
		}elseif(is_integer($value)){
			$output_array[] = $value;
		}
	}

	sort($output_array);

	return $output_array;
}