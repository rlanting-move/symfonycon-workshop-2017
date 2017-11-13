<?php
declare(strict_types = 1);

namespace SymfonyCon\Mastermind\Adapters\Session;

use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\Session\Storage\MockArraySessionStorage;
use SymfonyCon\Mastermind\Game\DecodingBoards;
use SymfonyCon\Mastermind\Game\DecodingBoardsTestCase;

/**
 * @group integration
 */
class SessionDecodingBoardsTest extends DecodingBoardsTestCase
{
    protected function createDecodingBoards(): DecodingBoards
    {
        return new SessionDecodingBoards(new Session(new MockArraySessionStorage()));
    }
}
