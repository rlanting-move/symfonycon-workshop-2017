<?php
declare(strict_types=1);

namespace SymfonyCon\Mastermind\Adapters\Web\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;
use Twig\Environment as Twig;

class DecodingBoardController
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
     * @Route("/games/{uuid}", methods={"GET", "POST"}, name="mastermind.board")
     */
    public function boardAction()
    {
        return new Response($this->twig->render('game/board.html.twig'));
    }
}
