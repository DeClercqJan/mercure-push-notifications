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


        // Link: <http://localhost:3000/.well-known/mercure>; rel="mercure"
        $discovery->addLink($request);
        // werkt gelijk niet
//        $authorization->createCookie($request, ['https://example.com/books/1']);
        $userName = 'janneman';

        // todo: deze injecteren via variabele
        $mercureSecretKey = '!ChangeMe!';

        $token = (new Builder())
            ->withClaim('mercure', ['subscribe' => [sprintf('%s', $userName)]])
            ->getToken(
                new Sha256(),
                new Key($mercureSecretKey)
            );

        $response = new JsonResponse([
            '@id' => '/demo/books/1',
            'availability' => 'https://schema.org/InStock',
        ]);

        // todo: deze nog toerpassen: https://github.com/dunglas/mercure/blob/main/spec/mercure.md
        $response->headers->setCookie(
            new Cookie('mercureAuthorization',
                $token->toString(),
                (new \DateTime())->add(new \DateInterval('PT5H')),
//            '/.well-known/mercure',
            '/',
            null,
            false,
                true,
                false,
            'strict'
            ));

        return $response;
    }
}
