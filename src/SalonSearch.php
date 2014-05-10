<?php
/**
 * Created by PhpStorm.
 * User: Leonardo Shinagawa
 * Date: 09/05/14
 * Time: 21:30
 */

namespace ebussola\ihair;


class SalonSearch
{

    /**
     * @var \GooglePlaces
     */
    protected $google_places;

    public function __construct(\GooglePlaces $google_places)
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
    public function getSalonsByLocation($geolocation, $radius = 100)
    {
        $this->google_places->location = $geolocation;
        $this->google_places->radius = $radius;
        $result = $this->google_places->nearbySearch();

        $result_data = $result['results'];

        while (isset($result['next_page_token'])) {
            $this->google_places->pagetoken = $result['next_page_token'];
            $result = $this->google_places->nearbySearch();
            $result_data = array_merge($result_data, $result['results']);
        }

        return $result_data;
    }

} 