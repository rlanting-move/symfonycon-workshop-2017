<?php
declare(strict_types=1);

namespace SymfonyCon\Mastermind\Game;

use PHPUnit\Framework\TestCase;

class DecodingBoardTest extends TestCase
{
    const NUMBER_OF_ATTEMPTS = 12;

    public function test_makeGuess_gives_feedback_on_the_guess()
    {
        $uuid = GameUuid::existing('547bf8e4-1a9c-492e-a0cf-165b809585a2');
        $exactHits = 1;
        $colourHits = 3;
        $guessCode = $this->prophesize(Code::class);
        $secretCode = $this->prophesize(Code::class);

        $secretCode->exactHits($guessCode)->willReturn($exactHits);
        $secretCode->colourHits($guessCode)->willReturn($colourHits);

        $board = new DecodingBoard($uuid, $secretCode->reveal(), self::NUMBER_OF_ATTEMPTS);
        $feedback = $board->makeGuess($guessCode->reveal());

        $this->assertEquals(new Feedback($guessCode->reveal(), $exactHits, $colourHits), $feedback);
    }
}
