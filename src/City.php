<?php

    class City {
        private $name;
        private $id;

        function __construct($name, $id = null)
        {
            $this->name = $name;
            $this->id = $id;
        }

        function setCity($new_name)
        {
            $this->name = $new_name;
        }

        function getCity()
        {
            return $this->name;
        }

        function getId()
        {
            return $this->id;
        }

        function save()
        {
            $GLOBALS['DB']->exec("INSERT INTO cities (name) VALUES ('{$this->getCity()}');");
            $this->id = $GLOBALS['DB']->lastInsertId();
        }

        static function getAll()
        {
            $returned_cities = $GLOBALS['DB']->query("SELECT * FROM cities;");
            $cities = array();
            foreach($returned_cities as $city) {
                $name = $city['name'];
                $id = $city['id'];
                $new_city = new City($name, $id);
                array_push($cities, $new_city);
            }
            return $cities;
        }

        static function deleteAll()
        {
            $GLOBALS['DB']->exec("DELETE FROM cities;");
        }

        static function find($id)
        {
            $found_city = null;
            $all_cities = City::getAll();
            foreach($all_cities as $city) {
                $city_id = $city->getId();
                if ($city_id == $id) {
                    $found_city = $city;
                }
            }
            return $found_city;
        }

        function getDepartingFlights()
        {
            $found_flights = $GLOBALS['DB']->query("SELECT flights.* FROM cities JOIN flights USE (cities.id == flights.departure_id) WHERE id = {$this->getId()}";);
            $departing_flights = array();
            foreach($found_flights as $flight) {
                $id = $flight['id'];
                $departure_id = $flight['departure_id'];
                $arrival_id = $flight['arrival_id'];
                $flight_number = $flight['flight_number'];
                $status = $flight['status'];
                $departure_date = $flight['departure_date'];
                $departure_time = $flight['departure_time'];
                $new_flight = new Flight($departure_id, $arrival_id, $flight_number, $status, $departure_date, $departure_time, $id);
                array_push($departing_flights, $new_flight);
            }
            return $departing_flights;
        }

        function getArrivingFlights()
        {
         $found_flights = $GLOBALS['DB']->query("SELECT flights.* FROM cities JOIN flights USE (cities.id == flights.arrival_id) WHERE id = {$this->getId()}";);
            $arriving_flights = array();
            foreach($found_flights as $flight) {
                $id = $flight['id'];
                $departure_id = $flight['departure_id'];
                $arrival_id = $flight['arrival_id'];
                $flight_number = $flight['flight_number'];
                $status = $flight['status'];
                $departure_date = $flight['departure_date'];
                $departure_time = $flight['departure_time'];
                $new_flight = new Flight($departure_id, $arrival_id, $flight_number, $status, $departure_date, $departure_time, $id);
                array_push($arriving_flights, $new_flight);
            }
            return $arriving_flights;   
        }
    }

 ?>
