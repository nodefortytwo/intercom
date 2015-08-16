<?php

require("flatten.php");

class Tests extends PHPUnit_Framework_TestCase
{
    //basic positive test
    public function testSimpleFlatten(){
        
        $in = [
            2,
            4,
            5,
            8,
            [3, 7, [23, 56]],
            98,
            90
        ];

        $out = [2, 3, 4, 5, 7, 8, 23, 56, 90, 98];

        $this->assertEquals(flatten_array($in), $out);

    }

    //duplicate ints should still be allowed
    public function testSimpleFlattenDuplicates(){
        
        $in = [
            2,
            4,
            5,
            8,
            [3, 7, [23, 56]],
            98, 2, 8,
            90
        ];

        $out = [2, 2, 3, 4, 5, 7, 8, 8, 23, 56, 90, 98];

        $this->assertEquals(flatten_array($in), $out);

    }

    //test that non-integers are stripped from the array
    public function testSimpleFlattenString(){
        
        $in = [3, 6, 2, 'a', 'j'];

        $out = [2, 3, 6];

        $this->assertEquals(flatten_array($in), $out);

    }

    //test empty arrays
    public function testFlattenEmpty(){
        
        $in = [];

        $out = [];

        $this->assertEquals(flatten_array($in), $out);

    }

    //test exceptions
    public function testException(){
        $this->setExpectedException(
          'Exception', 'Argument 1 must be an array'
        );

        $in = null;

        flatten_array($in);
    }

}
