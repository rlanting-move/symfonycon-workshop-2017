<?php
declare(strict_types=1);

namespace SymfonyCon\Mastermind\UseCase;

use PHPUnit\Framework\TestCase;
use SymfonyCon\Mastermind\Game\Code;
use SymfonyCon\Mastermind\Game\DecodingBoard;
use SymfonyCon\Mastermind\Game\DecodingBoards;
use SymfonyCon\Mastermind\Game\Feedback;
use SymfonyCon\Mastermind\Game\GameUuid;

class MakeGuessUseCaseTest extends TestCase
{
    const GAME_UUID = '32915568-55ac-48d1-b817-9d8fa9cdff6b';

    /**
     * @var MakeGuessUseCase
     */
    private $useCase;
    /**
     * @var DecodingBoards|ObjectProphecy
     */
    private $boards;

    /**
     * @var DecodingBoard|ObjectProphecy
     */
    private $board;

    /**
     * @var Feedback|ObjectProphecy
     */
    private $feedback;

    /**
     * @var Code
     */
    private $code;

    /**
     * @var GameUuid
     */
    private $uuid;

    protected function setUp()
    {
        $this->board = $this->prophesize(DecodingBoard::class);
        $this->code = $this->prophesize(Code::class)->reveal();
        $this->uuid = GameUuid::existing(self::GAME_UUID);
        $this->feedback = $this->prophesize(Feedback::class);

        $this->boards = $this->prophesize(DecodingBoards::class);
        $this->useCase = new MakeGuessUseCase($this->boards->reveal());
    }

    public function test_it_makes_a_guess()
    {
        $this->board->makeGuess($this->code)->willReturn($this->feedback);
        $this->boards->get($this->uuid)->willReturn($this->board);

        $this->useCase->execute($this->uuid, $this->code);

        $this->board->makeGuess($this->code)->shouldHaveBeenCalled();
    }
}
