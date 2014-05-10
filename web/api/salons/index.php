<?php
/**
 * Created by PhpStorm.
 * User: Leonardo Shinagawa
 * Date: 07/05/14
 * Time: 22:11
 */

use ebussola\ihair\SalonSearch;

require __DIR__ . '/../../../bootstrap.php';

$app->get(
    '/',
    function () use ($app) {
        $latlng = $app->request->get('latlng');

        /** @var SalonSearch $salon_search */
        $salon_search = $app->container->salon_search;
        $geolocation = explode(',', $latlng);

        $result_data = $salon_search->getSalonsByLocation($geolocation);

        $app->response->setBody(json_encode($result_data));
    }
);

$app->run();