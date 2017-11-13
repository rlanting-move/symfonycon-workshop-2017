<?php
declare(strict_types=1);

namespace SymfonyCon\Mastermind\UseCase;

use SymfonyCon\Mastermind\Game\DecodingBoard;
use SymfonyCon\Mastermind\Game\DecodingBoards;

class ViewDecodingBoardUseCase
{
    /**
     * @var DecodingBoards
     */
    private $boards;

    public function __construct(DecodingBoards $boards)
    {
        $this->boards = $boards;
    }

    public function execute($gameUuid): DecodingBoard
    {
        return $this->boards->get($gameUuid);
    }
}
