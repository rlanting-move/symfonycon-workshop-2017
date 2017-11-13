<?php
declare(strict_types=1);

namespace SymfonyCon\Mastermind\Adapters\Session;

use SymfonyCon\Mastermind\Game\DecodingBoard;
use SymfonyCon\Mastermind\Game\DecodingBoardNotFoundException;
use SymfonyCon\Mastermind\Game\DecodingBoards;
use SymfonyCon\Mastermind\Game\GameUuid;

final class SessionDecodingBoards implements DecodingBoards
{
    /**
     * @throws DecodingBoardNotFoundException
     */
    public function get(GameUuid $uuid): DecodingBoard
    {
    }

    public function put(DecodingBoard $decodingBoard)
    {
    }
}
