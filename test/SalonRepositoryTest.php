<?php
use Doctrine\DBAL\DriverManager;
use ebussola\ihair\SalonRepository;
use Jackalope\RepositoryFactoryDoctrineDBAL;
use PHPCR\SimpleCredentials;

/**
 * Created by PhpStorm.
 * User: Leonardo Shinagawa
 * Date: 20/05/14
 * Time: 21:02
 */

class SalonRepositoryTest extends PHPUnit_Framework_TestCase
{

    /**
     * @var \ebussola\ihair\SalonRepository
     */
    protected $salon_repository;

    /**
     * @var \PHPCR\SessionInterface
     */
    protected $session;

    public function setUp()
    {
        $config = include __DIR__ . '/parameters.php';
        $this->salon_repository = \ebussola\ihair\SalonFactory::getRepository($config['db']);
    }

    public function testSaveSalon()
    {
        $salon = new \ebussola\ihair\salon\Salon();
        $salon->id = uniqid(time());
        $salon->name = 'Rose Coiffeur';
        $salon->rating = 5;
        $salon->vinicity = 'Rua do Catete';
        $salon->location = new \ebussola\ihair\Location(21, 22);

        $this->salon_repository->saveSalon($salon);
        $this->assertNotNull($salon->id);

        $same_salon = $this->salon_repository->getSalon($salon->id);
        $this->assertInstanceOf('\ebussola\ihair\Salon', $same_salon);
        $this->assertSame($same_salon->id, $salon->id);
        $this->assertSame($same_salon->name, $salon->name);
        $this->assertSame($same_salon->rating, $salon->rating);
        $this->assertSame($same_salon->vicinity, $salon->vicinity);
        $this->assertInstanceOf('\ebussola\ihair\Location', $same_salon->location);
    }

}