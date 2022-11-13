<?php
declare(strict_types = 1);

namespace App\Controller;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mercure\HubInterface;
use Symfony\Component\Mercure\Update;
use Symfony\Component\Routing\Annotation\Route;

class PublishController implements ControllerInterface
{
//    /**
//     * @Route("/publish", name="publish")
//     */
//    public function publish(HubInterface $hub): Response
//    {
//        $update = new Update(
//            'http://example.com/books/1',
//            json_encode(['status' => 'OutOfStock'])
//        );
//
//        $hub->publish($update);
//
//        return new Response('published!');
//    }

    /**
     * @Route("/publish2", name="publish2")
     */
    public function publish2(HubInterface $hub): Response
    {
        $update = new Update(
            'https://example.com/books/2',
            json_encode(['status' => 'OutOfStock2'])
        );

        $hub->publish($update);

//        return new Response('published2!');
        return new JsonResponse('published2!');
    }

    /**
     * @Route("/publish3", name="publish3")
     */
    public function publish(HubInterface $hub): Response
    {
        $update = new Update(
            'https://example.com/books/3',
            json_encode(['status' => 'OutOfStock3'])
        );

        $hub->publish($update);

        return new Response('published!');
    }


    /**
     * @Route("/private", name="private")
     */
    public function private(HubInterface $hub): Response
    {
        $update = new Update(
            'https://example.com/books/3',
            json_encode(['status' => 'OutOfStock1private']),
            true
        );

        // Publisher's JWT must contain this topic, a URI template it matches or * in mercure.publish or you'll get a 401
        // Subscriber's JWT must contain this topic, a URI template it matches or * in mercure.subscribe to receive the update
        $hub->publish($update);

//        return new Response('private update published!');
        return new JsonResponse('private update published!');
    }

}
