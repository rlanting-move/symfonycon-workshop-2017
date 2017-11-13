<?php
declare(strict_types=1);

namespace SymfonyCon\Mastermind\Game;

use PHPUnit\Framework\TestCase;

class DecodingBoardTest extends TestCase
{
    const NUMBER_OF_ATTEMPTS = 12;

    /**
     * @var DecodingBoard
     */
    private $board;

    /**
     * @var GameUuid
     */
    private $uuid;

    /**
     * @var Code|ObjectProphecy
     */
    private $guessCode;

    /**
     * @var Code|ObjectProphecy
     */
    private $secretCode;

    protected function setUp()
    {
        $this->uuid = GameUuid::existing('547bf8e4-1a9c-492e-a0cf-165b809585a2');
        $this->guessCode = $this->prophesize(Code::class);
        $this->secretCode = $this->prophesize(Code::class);
        $this->board = new DecodingBoard($this->uuid, $this->secretCode->reveal(), self::NUMBER_OF_ATTEMPTS);
    }

    public function test_makeGuess_gives_feedback_on_the_guess()
    {
        $exactHits = 1;
        $colourHits = 3;

        $this->secretCode->exactHits($this->guessCode)->willReturn($exactHits);
        $this->secretCode->colourHits($this->guessCode)->willReturn($colourHits);

        $feedback = $this->board->makeGuess($this->guessCode->reveal());

        $this->assertEquals(new Feedback($this->guessCode->reveal(), $exactHits, $colourHits), $feedback);
    }
}
