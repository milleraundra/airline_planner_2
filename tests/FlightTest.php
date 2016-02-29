<?php

/**
    * @backupGlobals disabled
    * @backupStaticAttributes disabled
    */

    require_once "src/Flight.php";

    $server = 'mysql:host=localhost;dbname=airline_planner_test';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);


    class FlightTest extends PHPUnit_Framework_TestCase
    {
        function test_allGetters()
        {
            $departure_id = 3;
            $arrival_id = 4;
            $flight_number = "FF900";
            $status = "On-Time";
            $departure_time = "2015-01-01 01:01:01";
            $arrival_time = "2015-01-01 01:01:01";
            $id = null;

            $test_flight = new Flight($departure_id, $arrival_id, $flight_number, $status, $departure_time, $arrival_time, $id);

            $result1 = $test_flight->getDepartureId();
            $result2 = $test_flight->getArrivalId();
            $result3 = $test_flight->getFlightNumber();
            $result4 = $test_flight->getStatus();
            $result5 = $test_flight->getDepartureTime();
            $result6 = $test_flight->getArrivalTime();

            $this->assertEquals($departure_id, $result1);
            $this->assertEquals($arrival_id, $result2);
            $this->assertEquals($flight_number, $result3);
            $this->assertEquals($status, $result4);
            $this->assertEquals($departure_time, $result5);
            $this->assertEquals($arrival_time, $result6);
        }

        function test_getId()
        {
            $departure_id = 3;
            $arrival_id = 4;
            $flight_number = "FF900";
            $status = "On-Time";
            $departure_time = "2015-01-01 01:01:01";
            $arrival_time = "2015-01-01 01:01:01";
            $id = 1;

            $test_flight = new Flight($departure_id, $arrival_id, $flight_number, $status, $departure_time, $arrival_time, $id);

            $result = $test_flight->getId();

            $this->assertEquals($id, is_numeric($result));
        }


    }

 ?>
