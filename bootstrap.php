<?php
/**
 * Created by PhpStorm.
 * User: Leonardo Shinagawa
 * Date: 07/05/14
 * Time: 22:21
 */


require __DIR__ . '/vendor/autoload.php';

$app = new \Slim\Slim([
    'view' => new \Slim\Views\Twig(),
    'templates.path' => __DIR__ . '/views/'
]);

$env = 'development';
if (getenv('ENV')) {
    $env = getenv('ENV');
}
$app->container->config = include __DIR__ . '/config/parameters_'.$env.'.php';
$app->config('debug', $app->container->config['env'] == 'development');

require __DIR__ . '/config/container.php';