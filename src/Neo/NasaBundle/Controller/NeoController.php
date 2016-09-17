<?php

namespace Neo\NasaBundle\Controller;

use Doctrine\MongoDB\Query\Query;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;

class NeoController extends Controller
{
    /**
     * @Route("/neo/hazardous")
     */
    public function hazardousAction()
    {
        $result = $this->get('doctrine_mongodb')
                ->getManager()
                ->createQueryBuilder('NeoNasaBundle:Asteroid')
                ->hydrate(false)
                ->field('is_potentially_hazardous_asteroid')->equals(true)
                ->getQuery()
                ->execute();

        return new JsonResponse($result->toArray());
    }

    /**
     * @Route("/neo/fastest")
     */
    public function fastestAction()
    {
        $result = $this->get('doctrine_mongodb')
                ->getManager()
                ->createQueryBuilder('NeoNasaBundle:Asteroid')
                ->hydrate(false)
                ->sort('kilometers_per_hour','desc')
                ->limit(1)
                ->getQuery()
                ->execute();

        return new JsonResponse($result->toArray());
    }
}
