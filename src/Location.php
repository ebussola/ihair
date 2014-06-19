<?php
/**
 * Created by PhpStorm.
 * User: Leonardo Shinagawa
 * Date: 18/06/14
 * Time: 22:14
 */

namespace ebussola\ihair;


class Location {

    /**
     * @var float
     */
    public $latitude;

    /**
     * @var float
     */
    public $longitude;

    public function __construct($latitude, $longitude)
    {
        $this->latitude = $latitude;
        $this->longitude = $longitude;
    }

} 