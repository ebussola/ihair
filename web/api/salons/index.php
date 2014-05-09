<?php
/**
 * Created by PhpStorm.
 * User: Leonardo Shinagawa
 * Date: 07/05/14
 * Time: 22:11
 */

require __DIR__ . '/../../../bootstrap.php';

$app->get('/', function() use ($app) {
    $latlng = $app->request->get('latlng');
    $radius = $app->request->get('radius', 200);

    /** @var GooglePlaces $google_places */
    $google_places = $app->container->google_places;
    $geolocation = explode(',', $latlng);

    $google_places->location = $geolocation;
    $google_places->radius = $radius;
    $result = $google_places->nearbySearch();

    $app->response->setBody(json_encode($result['results']));
});

$app->run();