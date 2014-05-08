<?php
/**
 * Created by PhpStorm.
 * User: Leonardo Shinagawa
 * Date: 07/05/14
 * Time: 22:26
 */

$app->container->singleton('google_places', function() use ($app) {
    $config = $app->container->config;

    $google_places = new GooglePlaces($config['google-api-key']);
    $google_places->types = ['beauty_salon', 'hair_care'];

    return $google_places;
});