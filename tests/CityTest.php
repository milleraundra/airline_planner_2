<?php

/**
    * @backupGlobals disabled
    * @backupStaticAttributes disabled
    */

    require_once "src/City.php";

    $server = 'mysql:host=localhost;dbname=airline_planner_test';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);


    class CityTest extends PHPUnit_Framework_TestCase
    {

        protected function tearDown()
          {
              City::deleteAll();
          }

        function test_getName()
        {
            $name = "Portland";
            $id = null;
            $test_city = new City($name, $id);

            $result = $test_city->getCity();

            $this->assertEquals($name, $result);

        }

        function test_getId()
        {
            $name = "Portland";
            $id = 1;
            $test_city = new City($name, $id);

            $result = $test_city->getId();

            $this->assertEquals($id, is_numeric($result));
        }

        function test_save()
        {
            $name = "Portland";
            $id = null;
            $test_city = new City($name, $id);

            $test_city->save();

            $result = City::getAll();
            $this->assertEquals($test_city, $result[0]);
        }

        function test_getAll()
        {
            $name = "Portland";
            $id = null;
            $test_city = new City($name, $id);

            $name2 = "Seattle";
            $test_city2 = new City($name2, $id);

            $test_city->save();
            $test_city2->save();

            $result = City::getAll();
            $this->assertEquals([$test_city, $test_city2], $result);
        }

        function test_deleteAll()
        {
            $name = "Portland";
            $id = null;
            $test_city = new City($name, $id);

            $name2 = "Seattle";
            $test_city2 = new City($name2, $id);

            $test_city->save();
            $test_city2->save();
            City::deleteAll();
            $result = City::getAll();

            $this->assertEquals([], $result);

        }

        function test_find()
        {
            $name = "Seattle";
            $id = null;
            $test_city = new City($name, $id);
            $test_city->save();

            $name2 = "Chicago";
            $test_city2 = new City($name2, $id);
            $test_city2->save();

            $result = City::find($test_city->getId());

            $this->assertEquals($test_city, $result);
        }

        function test_get

    }




 ?>
