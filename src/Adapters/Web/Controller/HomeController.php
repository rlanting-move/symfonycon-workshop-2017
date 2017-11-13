<?php
declare(strict_types=1);

namespace SymfonyCon\Mastermind\Adapters\Web\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;
use Twig\Environment as Twig;

class HomeController
{
    /**
     * @var Twig
     */
    private $twig;

    public function __construct(Twig $twig)
    {
        $this->twig = $twig;
    }

    /**
     * @Route("/", methods={"GET"})
     */
    public function homeAction()
    {
        return new Response($this->twig->render('game/home.html.twig'));
    }
}
