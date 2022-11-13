<?php
declare(strict_types = 1);

namespace App\Controller;


use Lcobucci\JWT\Builder;
use Lcobucci\JWT\Signer\Hmac\Sha256;
use Lcobucci\JWT\Signer\Key;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Mercure\Discovery;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Cookie;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mercure\Authorization;
use Symfony\Component\Validator\Constraints\DateTime;

class DiscoverController implements ControllerInterface
{
//    /**
//     * @Route("/publish", name="publish")
//     */
//    public function publish(Request $request, Discovery $discovery, Authorization $authorization): Response
//    {
//        $discovery->addLink($request);
//
//        $response = new JsonResponse([
//            '@id' => '/demo/books/1',
//            'availability' => 'https://schema.org/InStock',
//        ]);
//
//        $response->headers->setCookie(
//            $authorization->createCookie($request, ["http://example.com/books/1"])
//        );
//
//        return $response;
//    }

    /**
     * @Route("/discover", name="discover")
     */
    public function __invoke(Request $request, Discovery $discovery, Authorization $authorization): JsonResponse
    {
        // todo: this doesn't work
        // Link: <https://hub.example.com/.well-known/mercure>; rel="mercure"
        $discovery->addLink($request);

        return new JsonResponse([
            'id' => '/books/3',
            'availability' => 'https://schema.org/InStock',
        ]);
    }

    /**
     * @Route("/subscribe", name="subscribe")
     */
    public function subscribeAction(Request $request, Discovery $discovery, Authorization $authorization): JsonResponse
    {
        // todo: this doesn't work
        // Link: <https://hub.example.com/.well-known/mercure>; rel="mercure"
        $discovery->addLink($request);
        $authorization->setCookie($request, ['https://example.com/books/3']);

        return new JsonResponse([
            'id' => '/books/3',
            'availability' => 'https://schema.org/InStock',
        ]);
    }
}
