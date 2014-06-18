<?php
/**
 * Created by PhpStorm.
 * User: Leonardo Shinagawa
 * Date: 07/05/14
 * Time: 22:21
 */


require __DIR__ . '/vendor/autoload.php';

$env = 'development';
if (getenv('ENV')) {
    $env = getenv('ENV');
}
$config = include __DIR__ . '/config/parameters_' . $env . '.php';

$app = new \Slim\Slim([
    'debug' => $config['env'] == 'development',
    'view' => new \Slim\Views\Twig(),
    'templates.path' => __DIR__ . '/views/',
    'log.writer' => new \Flynsarmy\SlimMonolog\Log\MonologWriter([
            'handlers' => $config['logger']['handlers']
        ])
]);

$app->container->config = $config;

require __DIR__ . '/config/container.php';