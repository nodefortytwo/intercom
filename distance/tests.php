<?php

require("functions.php");

class Tests extends PHPUnit_Framework_TestCase
{
    
	public function testCheckDistance(){

		$lat_one = 50;
		$lng_one = -10;

		$lat_two = 30;
		$lng_two = -5;

		$distance = calculate_distance($lat_one, $lng_one, $lat_two, $lng_two);
		
		$this->assertEquals(2265.57, $distance);

	}

	public function testParse(){
		$_ENV['office_lat'] = 53.3381985;
		$_ENV['office_lng'] = -6.2592576;
		
		$resource = fopen('test_assets/customer.json', 'r');

		$this->assertEquals(16,  count(process_data($resource)));
	}

	public function testParseLongRange(){
		$_ENV['office_lat'] = 1;
		$_ENV['office_lng'] = -1;
		
		$resource = fopen('test_assets/customer.json', 'r');
		
		$this->assertEquals(0,  count(process_data($resource)));
	}

	public function testBadParseLongRange(){
		$_ENV['office_lat'] = 53.3381985;
		$_ENV['office_lng'] = -6.2592576;
		
		$resource = fopen('test_assets/bad_customers.json', 'r');
		
		$this->assertEquals(14,  count(process_data($resource)));
	}

}
