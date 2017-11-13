<?php
declare(strict_types = 1);

namespace SymfonyCon\Mastermind\Adapters\Session;

use PHPUnit\Framework\TestCase;
use SymfonyCon\Mastermind\Game\DecodingBoards;

class DecodingBoardsTest extends TestCase
{
    /**
     * @var SessionDecodingBoards
     */
    protected $decodingBoards;

    protected function setUp()
    {
        $this->decodingBoards = new SessionDecodingBoards();
    }

    public function test_it_is_a_decoding_boards_repository()
    {
        $this->assertInstanceOf(DecodingBoards::class, $this->decodingBoards);
    }
}
