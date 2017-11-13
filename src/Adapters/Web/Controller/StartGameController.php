<?php

namespace SymfonyCon\Mastermind\Adapters\Web\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;

class StartGameController
{
    /**
     * @Route("/games", methods={"POST"}, name="mastermind.new_game")
     */
    public function newGameAction()
    {
        return new Response('');
    }
}
