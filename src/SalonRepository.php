<?php
/**
 * Created by PhpStorm.
 * User: Leonardo Shinagawa
 * Date: 19/05/14
 * Time: 22:45
 */

namespace ebussola\ihair;


use Doctrine\DBAL\Connection;
use ebussola\ihair\salon\Salon;
use Jackalope\RepositoryFactoryDoctrineDBAL;
use PHPCR\NodeInterface;
use PHPCR\SessionInterface;
use PHPCR\SimpleCredentials;

class SalonRepository
{

    /**
     * @var Connection
     */
    protected $conn;

    /**
     * @var SessionInterface
     */
    protected $session;

    public function __construct(Connection $conn, SessionInterface $session)
    {
        $this->conn = $conn;
        $this->session = $session;
    }

    /**
     * @param Salon $salon
     */
    public function saveSalon(Salon $salon)
    {
        $salon_root_node = $this->session->getNode('/salon');

        if ($salon_root_node->hasNode($salon->id)) {
            $salon_node = $salon_root_node->getNode($salon->id);
        } else {
            $salon_node = $salon_root_node->addNode($salon->id);
        }

        $salon_node->setProperty('name', $salon->name);
        $salon_node->setProperty('rating', $salon->rating);

        $this->session->save();
    }

    /**
     * @param string $salon_id
     * @return Salon
     */
    public function getSalon($salon_id)
    {
        $node = $this->session->getNode('/salon/' . $salon_id);

        return $this->makeSalon($node);
    }

    /**
     * @param string[] $salon_ids
     * @return Salon[]
     */
    public function getSalons(array $salon_ids)
    {
        $paths = [];
        foreach ($salon_ids as $salon_id) {
            $paths[] = '/salon/' . $salon_id;
        }

        $nodes = $this->session->getNodes($paths);
        $salons = [];
        foreach ($nodes as $node) {
            $nodes[] = $this->makeSalon($node);
        }

        return $salons;
    }

    /**
     * @param NodeInterface $node
     * @return Salon
     */
    private function makeSalon(NodeInterface $node)
    {
        $salon = new Salon();
        $salon->id = $node->getName();
        $salon->name = $node->getPropertyValue('name');
        $salon->rating = $node->getPropertyValue('rating');

        return $salon;
    }

} 