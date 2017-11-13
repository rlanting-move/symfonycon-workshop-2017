<?php
declare(strict_types=1);

namespace SymfonyCon\Mastermind\UseCase;

use SymfonyCon\Mastermind\Game\Code;
use SymfonyCon\Mastermind\Game\DecodingBoards;
use SymfonyCon\Mastermind\Game\GameUuid;

class MakeGuessUseCase
{
    /**
     * @var DecodingBoards
     */
    private $boards;

    public function __construct(DecodingBoards $boards)
    {
        $this->boards = $boards;
    }

    public function execute(GameUuid $gameUuid, Code $code)
    {
        $board = $this->boards->get($gameUuid);
        $board->makeGuess($code);
    }
}
