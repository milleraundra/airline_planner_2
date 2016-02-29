<?php

    class Flight
    {
        private $departure_id;
        private $arrival_id;
        private $flight_number;
        private $status;
        private $departure_time;
        private $arrival_time;
        private $id;

        function __construct($departure_id, $arrival_id, $flight_number, $status, $departure_time, $arrival_time, $id = null)
        {
            $this->departure_id = $departure_id;
            $this->arrival_id = $arrival_id;
            $this->flight_number = $flight_number;
            $this->status = $status;
            $this->departure_time = $departure_time;
            $this->arrival_time = $arrival_time;
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

        function getArrivalTime()
        {
            return $this->arrival_time;
        }

        function setArrivalTime($new_arrival_time)
        {
            $this->arrival_time = $new_arrival_time;
        }

        function getId()
        {
            return $this->id;
        }






    }

?>
