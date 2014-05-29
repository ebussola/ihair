<?php
/**
 * Created by PhpStorm.
 * User: Leonardo Shinagawa
 * Date: 07/05/14
 * Time: 22:23
 */

return [
    'env' => getenv('ENV'),

    'google-api-key' => getenv('GOOGLE_API_KEY'),

    'db' => [
        'driver' => getenv('DB_DRIVER'),
        'user' => getenv('DB_USER'),
        'password' => getenv('DB_PASSWORD'),
        'dbname' => getenv('DB_DBNAME'),
        'host' => getenv('DB_HOST')
    ],

    'logger' => array(
        'handlers' => array(
            new \Monolog\Handler\NullHandler()
        )
    )
];