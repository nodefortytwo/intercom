<?php

require 'functions.php';

$_ENV['office_lat'] = 53.3381985;
$_ENV['office_lng'] = -6.2592576;

$line = 0;

$customers_in_range = [];

//read file
$stdin = fopen('php://stdin', 'r');
$customers_in_range = process_data($stdin);

//sort list
ksort($customers_in_range);

foreach($customers_in_range as $customer){
	echo $customer->user_id . ": {$customer->name} is {$customer->distance}km away \n";
}
