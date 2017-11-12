<?php
declare(strict_types=1);

namespace SymfonyCon\Mastermind\Game;

use PHPUnit\Framework\TestCase;

class DecodingBoardTest extends TestCase
{
    public function test_it_is_initialized()
    {
        $this->assertInstanceOf(DecodingBoard::class, new DecodingBoard());
    }

    public function test_it_returns_last_feedback()
    {
        $board = new DecodingBoard();

        $this->assertInstanceOf(Feedback::class, $board->lastFeedback());
    }
}
