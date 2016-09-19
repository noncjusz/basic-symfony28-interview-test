<?php

namespace Neo\NasaBundle\Document;

use Doctrine\ODM\MongoDB\DocumentRepository;

class AsteroidRepository extends DocumentRepository
{
    public function findHazardous()
    {
        return $this->getDocumentManager()
            ->createQueryBuilder('NeoNasaBundle:Asteroid')
            ->hydrate(false)
            ->field('is_potentially_hazardous_asteroid')->equals(true)
            ->getQuery()
            ->execute();
    }

    public function findFastest()
    {
        return $result = $this->getDocumentManager()
            ->createQueryBuilder('NeoNasaBundle:Asteroid')
            ->hydrate(false)
            ->sort('kilometers_per_hour','desc')
            ->limit(1)
            ->getQuery()
            ->execute();
    }

    public function saveAsteroidsData(array $data)
    {
        foreach ($data as $date => $asteroids) {
            foreach ($asteroids as $asteroid) {
                $this->getDocumentManager()
                    ->createQueryBuilder("NeoNasaBundle:Asteroid")
                    ->findAndUpdate()
                    ->field("neo_reference_id")->equals($asteroid["neo_reference_id"])
                    ->field("date")->set($date)
                    ->field("name")->set($asteroid['name'])
                    ->field("kilometers_per_hour")->set($asteroid["close_approach_data"][0]["relative_velocity"]["kilometers_per_hour"])
                    ->field("is_potentially_hazardous_asteroid")->set($asteroid["is_potentially_hazardous_asteroid"])
                    ->upsert()
                    ->getQuery()
                    ->execute();
            }
        }
        return $this;
    }
}
