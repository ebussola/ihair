<?php
/**
 * Created by PhpStorm.
 * User: Leonardo Shinagawa
 * Date: 18/06/14
 * Time: 21:43
 */

namespace ebussola\ihair;


class SalonsController
{

    /**
     * @var SalonSearch
     */
    protected $salon_search;

    /**
     * @var SalonRepository
     */
    protected $salon_repository;

    public function __construct(SalonSearch $salon_search, SalonRepository $salon_repository)
    {
        $this->salon_search = $salon_search;
        $this->salon_repository = $salon_repository;
    }

    public function get($latlng, $radius, $client_id)
    {
        $geolocation = explode(',', $latlng);
        $result = null;
        $next_page = null;
        do {
            if (isset($result['next_page_token'])) {
                $next_page = $result['next_page_token'];
            }
            $result = $this->salon_search->getSalonsByLocation($geolocation, $radius, $next_page);
            $salons = $this->saveNewSalonsAndPrepare($result['results']);
            $this->sendToClient($client_id, $salons);

        } while (isset($result['next_page_token']));

        return true;
    }

    /**
     * @param $result_data
     */
    protected function saveNewSalonsAndPrepare($result_data)
    {
        $salon_ids = [];
        foreach ($result_data as $data) {
            $salon_ids[] = $data['id'];
        }
        $salons = $this->salon_repository->getSalons($salon_ids);

        // remove already registered salon
        foreach ($salons as $salon) {
            foreach ($result_data as $i => $data) {
                if ($salon->id == $data['id']) {
                    unset($result_data[$i]);
                }
            }
        }

        // register new salons
        foreach ($result_data as $data) {
            $salon = new \ebussola\ihair\salon\Salon();
            $salon->id = $data['id'];
            $salon->name = $data['name'];
            $salon->rating = 0;
            $salon->vicinity = $data['vicinity'];
            $salon->location = new Location($data['geometry']['location']['lat'], $data['geometry']['location']['lng']);
            $this->salon_repository->saveSalon($salon);

            $salons[] = $salon;
        }

        return $salons;
    }

    private function sendToClient($client_id, $salons)
    {
        $pusher = new \Pusher('95a73fe212094600645d', 'af98af7594206a5af0c0', '83592', true);
        $pusher->trigger('salons', (string)$client_id, json_encode($salons));
    }

} 