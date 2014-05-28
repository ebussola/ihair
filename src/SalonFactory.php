<?php
/**
 * Created by PhpStorm.
 * User: Leonardo Shinagawa
 * Date: 20/05/14
 * Time: 21:36
 */

namespace ebussola\ihair;


use Doctrine\DBAL\DriverManager;
use Jackalope\RepositoryFactoryDoctrineDBAL;
use PHPCR\SimpleCredentials;

class SalonFactory {

    /**
     * @param array $config_db
     * @return SalonRepository
     */
    public static function getRepository($config_db)
    {
        $conn = DriverManager::getConnection($config_db);
        $repository = (new RepositoryFactoryDoctrineDBAL())->getRepository(
            ['jackalope.doctrine_dbal_connection' => $conn]
        );
        $credentials = new SimpleCredentials(null, null);
        $session = $repository->login($credentials);

        return new SalonRepository($conn, $session);
    }

}