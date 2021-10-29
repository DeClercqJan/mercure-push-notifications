<?php
declare(strict_types = 1);

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mercure\HubInterface;
use Symfony\Component\Mercure\Update;
use Symfony\Component\Routing\Annotation\Route;

class PublishController implements ControllerInterface
{
    /**
     * @Route("/publish", name="publish")
     */
    public function publish(HubInterface $hub): Response
    {
        $update = new Update(
            'http://example.com/books/1',
            json_encode(['status' => 'OutOfStock'])
        );

        $hub->publish($update);

        return new Response('published!');
    }

    /**
     * @Route("/publish2", name="publish2")
     */
    public function publish2(HubInterface $hub): Response
    {
        $update = new Update(
            'http://example.com/books/2',
            json_encode(['status' => 'OutOfStock2'])
        );

        $hub->publish($update);

        return new Response('published2!');
    }
}
