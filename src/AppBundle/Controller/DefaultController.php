<?php

namespace AppBundle\Controller;

use Snc\RedisBundle\Client\Phpredis\Client;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends Controller
{
    /** @var  Client */
    private $redisClient;

    public function __construct(Client $client)
    {
        $this->redisClient = $client;
    }

    /**
     * @Route("/", name="homepage")
     */
    public function indexAction()
    {
        $redisKeys = $this->redisClient->get('*');
        return $this->json(['keys' => $redisKeys]);
    }
}
