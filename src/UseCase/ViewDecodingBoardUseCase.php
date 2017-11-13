<?php
declare(strict_types=1);

namespace SymfonyCon\Mastermind\UseCase;

use SymfonyCon\Mastermind\Game\Code;
use SymfonyCon\Mastermind\Game\DecodingBoard;
use SymfonyCon\Mastermind\Game\GameUuid;

class ViewDecodingBoardUseCase
{
    public function execute($gameUuid)
    {
        return new DecodingBoard(GameUuid::generated(), Code::fromString('Red'), 12);
    }
}
