<?php
/**
 * Created by PhpStorm.
 * User: Leonardo Shinagawa
 * Date: 08/05/14
 * Time: 19:58
 */

require __DIR__ . '/../bootstrap.php';

$app->get(
    '/',
    function () use ($app) {
        $app->render('pages/index.html.twig');
    }
);

$app->run();