<?php

    require_once __DIR__."/../vendor/autoload.php";
    require_once __DIR__."/../src/Flight.php";
    require_once __DIR__."/../src/City.php";

    $app = new Silex\Application();

    $app['debug'] = true;

    use Symfony\Component\HttpFoundation\Request;
    Request::enableHttpMethodParameterOverride();

    $server = 'mysql:host=localhost;dbname=airline_planner';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);

    $app->register(new Silex\Provider\TwigServiceProvider(), array(
        'twig.path' => __DIR__.'/../views'
    ));

    $app->get("/", function() use ($app) {
        $flights = Flight::getAll();
    return $app['twig']->render('index.html.twig', array('flights' => $flights));
    });

    $app->post("/add/flight", function() use ($app) {
        $new_flight = new Flight($_POST['departure_id'], $_POST['arrival_id'], $_POST['flight_number'], $_POST['status'], $_POST['departure_date'], $_POST['departure_time']);
        $new_flight->save();
        $flights = Flight::getAll();

    });

    return $app;



?>
