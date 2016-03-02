<?php

/**
    * @backupGlobals disabled
    * @backupStaticAttributes disabled
    */

    require_once "src/Flight.php";
    require_once "src/City.php";

    $server = 'mysql:host=localhost;dbname=airline_planner_test';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);


    class FlightTest extends PHPUnit_Framework_TestCase
    {
        protected function tearDown()
          {
              Flight::deleteAll();
          }

        function test_allGetters()
        {
            $name = "Portland";
            $id = null;
            $test_city1 = new City($name, $id);

            $name2 = "New York";
            $test_city2 = new City($name2, $id);

            $departure_id = $test_city1->getId();
            $arrival_id = $test_city2->getId();
            $flight_number = "FF900";
            $status = "On-Time";
            $departure_date = "2015-01-01";
            $departure_time = "01:01:01";
            $id = null;

            $test_flight = new Flight($departure_id, $arrival_id, $flight_number, $status, $departure_date, $departure_time, $id);

            $result1 = $test_flight->getDepartureId();
            $result2 = $test_flight->getArrivalId();
            $result3 = $test_flight->getFlightNumber();
            $result4 = $test_flight->getStatus();
            $result5 = $test_flight->getDepartureDate();
            $result6 = $test_flight->getDepartureTime();

            $this->assertEquals($departure_id, is_numeric($result1));
            $this->assertEquals($arrival_id, is_numeric($result2));
            $this->assertEquals($flight_number, $result3);
            $this->assertEquals($status, $result4);
            $this->assertEquals($departure_date, $result5);
            $this->assertEquals($departure_time, $result6);

        }

        function test_getId()
        {
            $departure_id = 3;
            $arrival_id = 4;
            $flight_number = "FF900";
            $status = "On-Time";
            $departure_date = "2015-01-01";
            $departure_time = "01:01:01";
            $id = 1;

            $test_flight = new Flight($departure_id, $arrival_id, $flight_number, $status, $departure_date, $departure_time, $id);

            $result = $test_flight->getId();

            $this->assertEquals($id, is_numeric($result));
        }

        function test_save()
        {
            $departure_id = 3;
            $arrival_id = 4;
            $flight_number = "FF900";
            $status = "On-Time";
            $departure_date = "2015-01-01";
            $departure_time = "01:01:01";
            $id = 1;

            $test_flight = new Flight($departure_id, $arrival_id, $flight_number, $status, $departure_date, $departure_time, $id);

            $test_flight->save();
            $result = Flight::getAll();

            $this->assertEquals([$test_flight], $result);
        }

        function test_getAll()
        {
            $departure_id = 3;
            $arrival_id = 4;
            $flight_number = "FF900";
            $status = "On-Time";
            $departure_date = "2015-01-01";
            $departure_time = "01:01:01";
            $id = 1;

            $departure_id2 = 5;
            $arrival_id2 = 5;
            $flight_number2 = "QZ900";
            $status2 = "Delayed";
            $departure_date2 = "2015-02-01";
            $departure_time2 = "01:02:01";
            $id = null;

            $test_flight = new Flight($departure_id, $arrival_id, $flight_number, $status, $departure_date, $departure_time, $id);
            $test_flight2 = new Flight($departure_id2, $arrival_id2, $flight_number2, $status2, $departure_date2, $departure_time2, $id);

            $test_flight->save();
            $test_flight2->save();

            $result = Flight::getAll();

            $this->assertEquals([$test_flight, $test_flight2], $result);
        }

        function test_deleteAll()
        {
            $departure_id = 3;
            $arrival_id = 4;
            $flight_number = "FF900";
            $status = "On-Time";
            $departure_date = "2015-01-01";
            $departure_time = "01:01:01";
            $id = 1;

            $departure_id2 = 5;
            $arrival_id2 = 5;
            $flight_number2 = "QZ900";
            $status2 = "Delayed";
            $departure_date2 = "2015-02-01";
            $departure_time2 = "01:02:01";
            $id = null;

            $test_flight = new Flight($departure_id, $arrival_id, $flight_number, $status, $departure_date, $departure_time, $id);
            $test_flight2 = new Flight($departure_id2, $arrival_id2, $flight_number2, $status2, $departure_date2, $departure_time2, $id);

            $test_flight->save();
            $test_flight2->save();

            Flight::deleteAll();
            $result = Flight::getAll();

            $this->assertEquals([], $result);

        }

        function test_find()
        {
           $departure_id = 3;
            $arrival_id = 4;
            $flight_number = "FF900";
            $status = "On-Time";
            $departure_date = "2015-01-01";
            $departure_time = "01:01:01";
            $id = 1;

            $departure_id2 = 5;
            $arrival_id2 = 5;
            $flight_number2 = "QZ900";
            $status2 = "Delayed";
            $departure_date2 = "2015-02-01";
            $departure_time2 = "01:02:01";
            $id = null;

            $test_flight = new Flight($departure_id, $arrival_id, $flight_number, $status, $departure_date, $departure_time, $id);
            $test_flight2 = new Flight($departure_id2, $arrival_id2, $flight_number2, $status2, $departure_date2, $departure_time2, $id);

            $test_flight->save();
            $test_flight2->save();

            $result = Flight::find($test_flight->getId());

            $this->assertEquals($test_flight, $result);
        }

        function test_update()
        {
            $departure_id = 3;
            $arrival_id = 4;
            $flight_number = "FF900";
            $status = "On-Time";
            $departure_date = "2015-01-01";
            $departure_time = "01:01:01";
            $id = 1;

            $test_flight = new Flight($departure_id, $arrival_id, $flight_number, $status, $departure_date, $departure_time, $id);

            $status2 = "Delayed";
            $departure_date2 = "2015-02-01";
            $departure_time2 = "01:02:01";

            $test_flight->update($status2, $departure_date2, $departure_time2);

            $result1 = $test_flight->getStatus();
            $result2 = $test_flight->getDepartureDate();
            $result3 = $test_flight->getDepartureTime();

            $this->assertEquals($status2, $result1);
            $this->assertEquals($departure_date2, $result2);
            $this->assertEquals($departure_time2, $result3);
        }

        function test_getDepartureCity()
        {
            $name = "Seattle";
            $id = null;
            $test_city = new City($name, $id);
            $test_city->save();

            $name2 = "Chicago";
            $test_city2 = new City($name2, $id);
            $test_city->save();

            $departure_id = $test_city->getId();
            $arrival_id = $test_city2->getId();
            $flight_number = "C3PO";
            $status = "On Time";
            $departure_date = "2016-03-30";
            $departure_time = "22:03:49";
            $new_flight = $
        }
    }

?>
