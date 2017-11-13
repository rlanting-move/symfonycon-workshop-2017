<?php
declare(strict_types=1);

namespace SymfonyCon\Mastermind\Game;

use PHPUnit\Framework\TestCase;
use Prophecy\Argument;
use Prophecy\Prophecy\ObjectProphecy;

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
        $this->secretCode->exactHits(Argument::any())->willReturn(0);
        $this->secretCode->colourHits(Argument::any())->willReturn(0);

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

    public function test_makeGuess_throws_a_NoAttemptsLeftException_if_number_of_attempts_is_exceeded()
    {
        $this->expectException(NoAttemptsLeftException::class);

        for ($i = 0; $i <= self::NUMBER_OF_ATTEMPTS; $i++) {
            $this->board->makeGuess($this->guessCode->reveal());
        }
    }
}
