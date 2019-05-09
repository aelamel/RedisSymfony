<?php

namespace AppBundle\Controller;

use Snc\RedisBundle\Client\Phpredis\Client;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
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
     * @Route("/", name="keys")
     */
    public function indexAction()
    {
        $redisKeys = $this->redisClient->keys('*');
        return $this->json(['keys' => $redisKeys]);
    }

    /**
     * @param $key
     * @param $value
     *
     * @Route("/{key}/{value}", name="create_key", methods={"GET"})
     *
     * @return JsonResponse
     */
    public function createKeyAction($key, $value) {

        $this->redisClient->set($key, $value);
        return $this->json([
            "status" => Response::HTTP_OK
        ]);
    }
}
