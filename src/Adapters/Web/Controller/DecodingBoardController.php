<?php
declare(strict_types=1);

namespace SymfonyCon\Mastermind\Adapters\Web\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\Response;
use SymfonyCon\Mastermind\Adapters\Web\Form\GuessForm;
use SymfonyCon\Mastermind\Game\GameUuid;
use SymfonyCon\Mastermind\UseCase\ViewDecodingBoardUseCase;
use Twig\Environment as Twig;

class DecodingBoardController
{
    /**
     * @var Twig
     */
    private $twig;

    /**
     * @var FormFactoryInterface
     */
    private $formFactory;

    /**
     * @var ViewDecodingBoardUseCase
     */
    private $viewDecodingBoardUseCase;

    public function __construct(Twig $twig, FormFactoryInterface $formFactory, ViewDecodingBoardUseCase $viewDecodingBoardUseCase)
    {
        $this->twig = $twig;
        $this->formFactory = $formFactory;
        $this->viewDecodingBoardUseCase = $viewDecodingBoardUseCase;
    }

    /**
     * @Route("/games/{uuid}", methods={"GET", "POST"}, name="mastermind.board")
     */
    public function boardAction(string $uuid)
    {
        $gameUuid = GameUuid::existing($uuid);
        $form = $this->formFactory->create(GuessForm::class, null, ['number_of_pegs' => 4]);
        $board = $this->viewDecodingBoardUseCase->execute($gameUuid);

        return new Response($this->twig->render('game/board.html.twig', ['form' => $form->createView(), 'board' => $board]));
    }
}
