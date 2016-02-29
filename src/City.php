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
    }

 ?>
