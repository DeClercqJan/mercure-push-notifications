<?php
declare(strict_types = 1);

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Contracts\Service\ServiceSubscriberInterface;

class HomeController implements ControllerInterface
{
    private $twig;

    public function __construct(\Twig\Environment $twig)
    {
        $this->twig = $twig;
    }

    /**
     * @Route("/home", name="home")
     */
    public function __invoke(): Response
    {
        $content = $this->twig->render('home.html.twig');

        return new Response($content);
    }
}
