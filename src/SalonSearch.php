<?php
/**
 * Created by PhpStorm.
 * User: Leonardo Shinagawa
 * Date: 09/05/14
 * Time: 21:30
 */

namespace ebussola\ihair;


use joshtronic\GooglePlaces;

class SalonSearch
{

    /**
     * @var GooglePlaces
     */
    protected $google_places;

    public function __construct(GooglePlaces $google_places)
    {
        $google_places->types = ['beauty_salon', 'hair_care'];
        $this->google_places = $google_places;
    }

    /**
     * @param array $geolocation
     * @param int $radius
     *
     * @return array
     */
    public function getSalonsByLocation($geolocation, $radius = 100, $next_page = null)
    {
        $this->google_places->location = $geolocation;
        $this->google_places->radius = $radius;
        if ($next_page != null) {
            $this->google_places->pagetoken = $next_page;
        }
        $result = $this->google_places->nearbySearch();

        return $result;
    }

} 