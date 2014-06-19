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

        $salons = $app->salons_controller->get($latlng, $radius);

        $app->response->setBody(json_encode($salons));
    }
);

$app->run();