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
        $radius = $app->request->get('radius');

        /** @var SalonSearch $salon_search */
        $salon_search = $app->container->salon_search;
        /** @var \ebussola\ihair\SalonRepository $salon_repository */
        $salon_repository = $app->salon_repository;
        $geolocation = explode(',', $latlng);

        $result_data = $salon_search->getSalonsByLocation($geolocation, $radius);
        $salon_ids = [];
        foreach ($result_data as $data) {
            $salon_ids[] = $data['id'];
        }

        $salons = $salon_repository->getSalons($salon_ids);

        $app->response->setBody(json_encode($salons));
    }
);

$app->run();