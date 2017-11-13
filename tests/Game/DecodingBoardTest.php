<?php
declare(strict_types=1);

namespace SymfonyCon\Mastermind\Game;

use PHPUnit\Framework\TestCase;
use Prophecy\Argument;
use Prophecy\Prophecy\ObjectProphecy;

class DecodingBoardTest extends TestCase
{
    const NUMBER_OF_ATTEMPTS = 12;
    const SECRET_LENGTH = 4;

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
        $this->secretCode->length()->willReturn(self::SECRET_LENGTH);
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

    public function test_allFeedback_exposes_all_past_feedback()
    {
        $code1 = $this->prophesize(Code::class)->reveal();
        $code2 = $this->prophesize(Code::class)->reveal();

        $this->board->makeGuess($code1);
        $this->board->makeGuess($code2);

        $allFeedback = $this->board->allFeedback();

        $this->assertContainsOnly(Feedback::class, $allFeedback);
        $this->assertCount(2, $allFeedback);
        $this->assertSame($code1, $allFeedback[0]->guessCode());
        $this->assertSame($code2, $allFeedback[1]->guessCode());
    }

    public function test_lastFeedback_exposes_the_last_feedback()
    {
        $code1 = $this->prophesize(Code::class)->reveal();
        $code2 = $this->prophesize(Code::class)->reveal();

        $this->board->makeGuess($code1);
        $this->board->makeGuess($code2);

        $lastFeedback = $this->board->lastFeedback();

        $this->assertInstanceOf(Feedback::class, $lastFeedback);
        $this->assertSame($code2, $lastFeedback->guessCode());
    }

    public function test_lastFeedback_returns_null_for_last_feedback_if_there_was_no_guess_attempt_yet()
    {
        $this->assertNull($this->board->lastFeedback());
    }

    public function test_the_game_is_won_if_all_colours_and_positions_are_guessed()
    {
        $this->secretCode->exactHits($this->guessCode)->willReturn(self::SECRET_LENGTH);

        $this->board->makeGuess($this->guessCode->reveal());

        $this->assertTrue($this->board->isGameWon());
    }

    public function test_the_game_is_not_won_if_some_of_the_colours_are_on_wrong_positions()
    {
        $this->secretCode->exactHits($this->guessCode)->willReturn(self::SECRET_LENGTH - 1);

        $this->board->makeGuess($this->guessCode->reveal());

        $this->assertFalse($this->board->isGameWon());
    }

    public function test_the_game_is_not_won_if_there_was_no_guess_attempt_yet()
    {
        $this->assertFalse($this->board->isGameWon());
    }

    public function test_the_game_lost_if_there_is_no_more_attempts_left_and_the_code_was_not_broken()
    {
        $this->secretCode->exactHits($this->guessCode)->willReturn(1);

        for ($i = 0; $i < self::NUMBER_OF_ATTEMPTS; $i++) {
            $this->board->makeGuess($this->guessCode->reveal());
        }

        $this->assertTrue($this->board->isGameLost());
    }

    public function test_the_game_is_not_lost_if_there_is_any_attempts_left()
    {
        $this->secretCode->exactHits($this->guessCode)->willReturn(1);

        for ($i = 0; $i < self::NUMBER_OF_ATTEMPTS - 1; $i++) {
            $this->board->makeGuess($this->guessCode->reveal());
        }

        $this->assertFalse($this->board->isGameLost());
    }

    public function test_the_game_is_not_lost_if_there_is_no_more_attempts_left_and_the_game_is_won()
    {
        $this->secretCode->exactHits($this->guessCode)->willReturn(self::SECRET_LENGTH);

        for ($i = 0; $i < self::NUMBER_OF_ATTEMPTS; $i++) {
            $this->board->makeGuess($this->guessCode->reveal());
        }

        $this->assertFalse($this->board->isGameLost());
    }

    public function test_the_game_is_finished_if_all_colours_and_positions_are_guessed()
    {
        $this->secretCode->exactHits($this->guessCode)->willReturn(self::SECRET_LENGTH);

        $this->board->makeGuess($this->guessCode->reveal());

        $this->assertTrue($this->board->isGameFinished());
    }

    public function test_the_game_is_not_finished_if_there_are_any_attempts_left()
    {
        $this->secretCode->exactHits($this->guessCode)->willReturn(1);

        for ($i = 0; $i < self::NUMBER_OF_ATTEMPTS - 1; $i++) {
            $this->board->makeGuess($this->guessCode->reveal());
        }

        $this->assertFalse($this->board->isGameFinished());
    }

    public function test_the_game_is_finished_if_there_is_no_more_attempts_left()
    {
        $this->secretCode->exactHits($this->guessCode)->willReturn(1);

        for ($i = 0; $i < self::NUMBER_OF_ATTEMPTS; $i++) {
            $this->board->makeGuess($this->guessCode->reveal());
        }

        $this->assertTrue($this->board->isGameFinished());
    }

    public function test_gameUuid_exposes_the_game_uuid()
    {
        $this->assertSame($this->uuid, $this->board->gameUuid());
    }
}
