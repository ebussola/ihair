<?php
/**
 * Created by PhpStorm.
 * User: Leonardo Shinagawa
 * Date: 07/05/14
 * Time: 22:11
 */

require __DIR__ . '/../../../bootstrap.php';

$app->get(
    '/',
    function () use ($app) {
        $latlng = $app->request->get('latlng');
        $radius = $app->request->get('radius');
        $client_id = $app->request->get('client_id');

        $app->salons_controller->get($latlng, $radius, $client_id);
    }
);

$app->run();