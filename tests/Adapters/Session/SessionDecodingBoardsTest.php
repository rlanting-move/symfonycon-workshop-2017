<?php
declare(strict_types = 1);

namespace SymfonyCon\Mastermind\Adapters\Session;

use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\Session\Storage\MockArraySessionStorage;
use SymfonyCon\Mastermind\Game\Code;
use SymfonyCon\Mastermind\Game\DecodingBoard;
use SymfonyCon\Mastermind\Game\DecodingBoardNotFoundException;
use SymfonyCon\Mastermind\Game\DecodingBoards;
use SymfonyCon\Mastermind\Game\GameUuid;

class DecodingBoardsTest extends TestCase
{
    const UUID = 'd97f4f5d-2f38-459e-a08d-3b950200ba25';
    const INVALID_UUID = '027808e1-7f0f-46d0-8b68-9b69eb100c4d';

    /**
     * @var SessionDecodingBoards
     */
    protected $decodingBoards;

    protected function setUp()
    {
        $this->decodingBoards = new SessionDecodingBoards(new Session(new MockArraySessionStorage()));
    }

    public function test_it_is_a_decoding_boards_repository()
    {
        $this->assertInstanceOf(DecodingBoards::class, $this->decodingBoards);
    }

    public function test_it_throws_no_board_found_exception_if_no_board_was_found()
    {
        $this->expectException(DecodingBoardNotFoundException::class);

        $uuid = GameUuid::existing(self::INVALID_UUID);
        $board = new DecodingBoard($uuid, Code::fromString('Red Blue'), 12);

        $this->decodingBoards->put($board);
        $this->decodingBoards->get(GameUuid::existing(self::UUID));
    }

    public function test_it_gets_the_previously_added_decoding_board()
    {
        $uuid = GameUuid::existing(self::UUID);
        $board = new DecodingBoard($uuid, Code::fromString('Red Blue'), 12);

        $this->decodingBoards->put($board);
        $foundBoard = $this->decodingBoards->get(GameUuid::existing(self::UUID));

        $this->assertEquals($board, $foundBoard);
    }
}
