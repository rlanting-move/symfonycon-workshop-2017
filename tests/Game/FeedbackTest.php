<?php
declare(strict_types=1);

namespace SymfonyCon\Mastermind\Game;

use PHPUnit\Framework\TestCase;

class FeedbackTest extends TestCase
{
    public function test_it_is_initialized()
    {
        $this->assertInstanceOf(Feedback::class, new Feedback());
    }
}
