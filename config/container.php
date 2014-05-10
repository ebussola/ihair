<?php
/**
 * Created by PhpStorm.
 * User: Leonardo Shinagawa
 * Date: 07/05/14
 * Time: 22:26
 */

use ebussola\ihair\SalonSearch;

$app->container->singleton(
    'google_places',
    function () use ($app) {
        $config = $app->container->config;

        $google_places = new GooglePlaces($config['google-api-key']);

        return $google_places;
    }
);

$app->container->singleton(
    'salon_search',
    function () use ($app) {
        $salon_search = new SalonSearch($app->container->google_places);

        return $salon_search;
    }
);