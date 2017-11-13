<?php
declare(strict_types = 1);

namespace SymfonyCon\Mastermind\Adapters\InMemory;

use SymfonyCon\Mastermind\Game\DecodingBoards;
use SymfonyCon\Mastermind\Game\DecodingBoardsTestCase;

class InMemoryDecodingBoardsTest extends DecodingBoardsTestCase
{
    protected function createDecodingBoards(): DecodingBoards
    {
        return new InMemoryDecodingBoards();
    }
}
