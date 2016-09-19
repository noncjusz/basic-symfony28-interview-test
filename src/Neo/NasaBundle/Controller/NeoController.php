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
            ->getRepository('NeoNasaBundle:Asteroid')
            ->findHazardous();

        return new JsonResponse($result->toArray());
    }

    /**
     * @Route("/neo/fastest")
     */
    public function fastestAction()
    {
        $result = $this->get('doctrine_mongodb')
            ->getRepository('NeoNasaBundle:Asteroid')
            ->findFastest();

        return new JsonResponse($result->toArray());
    }
}
