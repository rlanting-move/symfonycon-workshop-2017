<?php
declare(strict_types=1);

namespace SymfonyCon\Mastermind\UseCase;

use SymfonyCon\Mastermind\Game\DecodingBoard;

class ViewDecodingBoardUseCase
{
    public function execute($gameUuid)
    {
        return new DecodingBoard();
    }
}
