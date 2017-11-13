<?php
declare(strict_types=1);

namespace SymfonyCon\Mastermind\Adapters\InMemory;

use SymfonyCon\Mastermind\Game\DecodingBoard;
use SymfonyCon\Mastermind\Game\DecodingBoardNotFoundException;
use SymfonyCon\Mastermind\Game\DecodingBoards;
use SymfonyCon\Mastermind\Game\GameUuid;

final class InMemoryDecodingBoards implements DecodingBoards
{
    /**
     * @var DecodingBoard[]
     */
    private $boards = [];

    /**
     * @throws DecodingBoardNotFoundException
     */
    public function get(GameUuid $uuid): DecodingBoard
    {
        if (!isset($this->boards[(string) $uuid])) {
            throw new DecodingBoardNotFoundException($uuid);
        }

        return $this->boards[(string) $uuid];
    }

    public function put(DecodingBoard $decodingBoard)
    {
        $this->boards[(string) $decodingBoard->gameUuid()] = $decodingBoard;
    }
}
