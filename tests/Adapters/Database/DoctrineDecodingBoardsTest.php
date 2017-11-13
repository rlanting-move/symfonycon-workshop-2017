<?php
declare(strict_types=1);

namespace SymfonyCon\Mastermind\Adapters\Database;

use SymfonyCon\Mastermind\Game\Code;
use SymfonyCon\Mastermind\Game\DecodingBoard;
use SymfonyCon\Mastermind\Game\DecodingBoards;
use SymfonyCon\Mastermind\Game\DecodingBoardsTestCase;
use SymfonyCon\Mastermind\Game\GameUuid;

/**
 * @group integration
 */
class DoctrineDecodingBoardsTest extends DecodingBoardsTestCase
{
    use Doctrine;
    use SymfonyKernel;

    protected function createDecodingBoards(): DecodingBoards
    {
        return new DoctrineDecodingBoards($this->manager);
    }

    public function test_stored_board_is_fully_restored()
    {
        $uuid = GameUuid::existing(self::UUID);
        $secretCode = Code::fromString('Red Blue');
        $board = new DecodingBoard($uuid, $secretCode, 12);
        $board->makeGuess(Code::fromString('Red Red'));

        $this->decodingBoards->put($board);

        // clear the manager to make sure the object is fetched from the database
        $this->manager->clear();

        $foundBoard = $this->decodingBoards->get($uuid);

        $this->assertEquals($board, $foundBoard);
    }
}
