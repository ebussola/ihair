<?php
/**
 * Created by PhpStorm.
 * User: Leonardo Shinagawa
 * Date: 07/05/14
 * Time: 22:26
 */

use ebussola\ihair\SalonSearch;

if (getenv('ROLLBAR_ACCESS_TOKEN')) {
    Rollbar::init(array('access_token' => getenv('ROLLBAR_ACCESS_TOKEN')));
}

// GOOGLE PLACES
$app->container->singleton(
    'google_places',
    function () use ($app) {
        $config = $app->container->config;

        $google_places = new \joshtronic\GooglePlaces($config['google-api-key']);

        return $google_places;
    }
);

// SALON SEARCH
$app->container->singleton(
    'salon_search',
    function () use ($app) {
        $salon_search = new SalonSearch($app->container->google_places);

        return $salon_search;
    }
);

// SALON REPOSITORY
$app->container->singleton(
    'salon_repository',
    function () use ($app) {
        return \ebussola\ihair\SalonFactory::getRepository($app->config['db']);
    }
);