<?php
declare(strict_types=1);

namespace SymfonyCon\Mastermind\UseCase;

use SymfonyCon\Mastermind\Game\CodeMaker;
use SymfonyCon\Mastermind\Game\DecodingBoard;
use SymfonyCon\Mastermind\Game\DecodingBoards;
use SymfonyCon\Mastermind\Game\GameUuid;

class StartGameUseCase
{
    /**
     * @var DecodingBoards
     */
    private $boards;

    /**
     * @var CodeMaker
     */
    private $codeMaker;

    /**
     * @var int
     */
    private $numberOfAttempts;

    public function __construct(DecodingBoards $boards, CodeMaker $codeMaker, int $numberOfAttempts)
    {

        $this->boards = $boards;
        $this->codeMaker = $codeMaker;
        $this->numberOfAttempts = $numberOfAttempts;
    }

    public function execute(int $codeLength): GameUuid
    {
        $board = new DecodingBoard(
            GameUuid::generated(),
            $this->codeMaker->newCode($codeLength),
            $this->numberOfAttempts
        );

        $this->boards->put($board);

        return $board->gameUuid();
    }
}
