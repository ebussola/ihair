<?php
/**
 * Created by PhpStorm.
 * User: Leonardo Shinagawa
 * Date: 07/05/14
 * Time: 22:26
 */

use ebussola\ihair\SalonSearch;

Rollbar::init(array('access_token' => '1514c0d892d8421eb70d4878ab53a467'));

$app->container->singleton(
    'google_places',
    function () use ($app) {
        $config = $app->container->config;

        $google_places = new \joshtronic\GooglePlaces($config['google-api-key']);

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