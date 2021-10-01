<?php
declare(strict_types = 1);

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mercure\HubInterface;
use Symfony\Component\Mercure\Update;

class PublishController implements ControllerInterface
{
    public function publish(HubInterface $hub): Response
    {
        $update = new Update(
            // todo: deze wijzigingen
            'http://example.com/books/1',
            json_encode(['status' => 'OutOfStock'])
        );

        $hub->publish($update);

        return new Response('published!');
    }
}
