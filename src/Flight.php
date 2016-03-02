<?php

    class Flight
    {
        private $departure_id;
        private $arrival_id;
        private $flight_number;
        private $status;
        private $departure_date;
        private $departure_time;
        private $id;

        function __construct($departure_id, $arrival_id, $flight_number, $status, $departure_date, $departure_time, $id = null)
        {
            $this->departure_id = $departure_id;
            $this->arrival_id = $arrival_id;
            $this->flight_number = $flight_number;
            $this->status = $status;
            $this->departure_date = $departure_date;
            $this->departure_time = $departure_time;
            $this->id = $id;
        }

        function getDepartureId()
        {
            return $this->departure_id;
        }

        function setDepartureId($new_departure_id)
        {
            $this->departure_id = $new_departure_id;
        }

        function getArrivalId()
        {
            return $this->arrival_id;
        }

        function setArrivalId($new_arrival_id)
        {
            $this->arrival_id = $new_arrival_id;
        }

        function getFlightNumber()
        {
            return $this->flight_number;
        }

        function setFlightNumber($new_flight_number)
        {
            $this->flight_number = $new_flight_number;
        }

        function getStatus()
        {
            return $this->status;
        }

        function setStatus($new_status)
        {
            $this->status = $new_status;
        }

        function getDepartureTime()
        {
            return $this->departure_time;
        }

        function setDepartureTime($new_departure_time)
        {
            $this->departure_time = $new_departure_time;
        }

        function getDepartureDate()
        {
            return $this->departure_date;
        }

        function setDepartureDate($new_departure_date)
        {
            $this->departure_date = $new_departure_date;
        }

        function getId()
        {
            return $this->id;
        }

        function save()
        {
            $GLOBALS['DB']->exec("INSERT INTO flights (departure_id, arrival_id, flight_number, status, departure_time, departure_date) VALUES ({$this->getDepartureId()}, {$this->getArrivalId()}, '{$this->getFlightNumber()}', '{$this->getStatus()}', '{$this->getDepartureDate()}', '{$this->getDepartureTime()}');");
            $this->id = $GLOBALS['DB']->lastInsertId();
        }

        static function getAll()
        {
            $returned_flights = $GLOBALS['DB']->query("SELECT * FROM flights;");
            $flights = array();
            foreach($returned_flights as $flight) {
                $departure_id = $flight['departure_id'];
                $arrival_id = $flight['arrival_id'];
                $flight_number = $flight['flight_number'];
                $status = $flight['status'];
                $departure_date = $flight['departure_date'];
                $departure_time = $flight['departure_time'];
                $id = $flight['id'];

                $new_flight = new Flight($departure_id, $arrival_id, $flight_number, $status, $departure_date, $departure_time, $id);
                array_push($flights, $new_flight);
            }
            return $flights;
        }

        static function deleteAll()
        {
            $GLOBALS['DB']->exec("DELETE FROM flights;");
        }

        static function find($id)
        {
            $found_flight = null;
            $all_flights = Flight::getAll();
            foreach ($all_flights as $flight) {
                $flight_id = $flight->getId();
                if ($flight_id == $id) {
                    $found_flight = $flight;
                }
            }
            return $found_flight;
        }

        function update($new_status, $new_departure_date, $new_departure_time)
        {
            $GLOBALS['DB']->exec("UPDATE flights SET status = '{$new_status}', departure_date = '{$new_departure_date}', departure_time = '{$new_departure_time}';");
            $this->setStatus($new_status);
            $this->setDepartureDate($new_departure_date);
            $this->setDepartureTime($new_departure_time);
        }

        function getDepartureCity()
        {
            $found_departure_city = $GLOBALS['DB']->query("SELECT cities.* FROM flights JOIN cities ON (flights.departure_id == cities.id) WHERE id= {$this->getDepartureId()};");
            $name = $found_departure_city['name'];
            $id = $found_departure_city['id'];
            $departure_city = new City($name, $id);
            return $departure_city;
        }

        function getArrivalCity()
        {
            $found_arrival_city = $GLOBALS['DB']->query("SELECT cities.* FROM flights JOIN cities ON (flights.arrival_id == cities.id) where id = {$this->getArrivalId()};");
            $name = $found_arrival_city['name'];
            $id = $found_arrival_city['id'];
            $arrival_city = new City($name, $id);
            return $arrival_city;
        }



    }

?>
          
