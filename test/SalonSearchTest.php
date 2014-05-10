<?php

/**
 * Created by PhpStorm.
 * User: Leonardo Shinagawa
 * Date: 09/05/14
 * Time: 21:50
 */
class SalonSearchTest extends PHPUnit_Framework_TestCase
{

    /**
     * @var \ebussola\ihair\SalonSearch
     */
    protected $salon_search;

    public function setUp()
    {
        $config = include __DIR__ . '/parameters.php';
        $key = $config['google-api-key'];
        $google_places = new GooglePlaces($key);
        $this->salon_search = new \ebussola\ihair\SalonSearch($google_places);
    }

    public function testGetSalonsByLocation()
    {
        $salons = $this->salon_search->getSalonsByLocation(['-22.9324794', '-43.177336']);

        $this->assertTrue(is_array($salons));
        $this->assertGreaterThan(0, count($salons));
    }

}