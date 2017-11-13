<?php
declare(strict_types=1);

namespace SymfonyCon\Mastermind\Adapters\Web\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Routing\RouterInterface;
use SymfonyCon\Mastermind\UseCase\StartGameUseCase;

class StartGameController
{
    const DEFAULT_CODE_LENGTH = 4;

    /**
     * @var StartGameUseCase
     */
    private $useCase;

    /**
     * @var RouterInterface
     */
    private $router;

    public function __construct(StartGameUseCase $useCase, RouterInterface $router)
    {
        $this->useCase = $useCase;
        $this->router = $router;
    }

    /**
     * @Route("/games", methods={"POST"}, name="mastermind.new_game")
     */
    public function newGameAction()
    {
        $gameUuid = $this->useCase->execute(self::DEFAULT_CODE_LENGTH);

        return new RedirectResponse($this->router->generate('mastermind.board', ['uuid' => (string)$gameUuid]));
    }
}
