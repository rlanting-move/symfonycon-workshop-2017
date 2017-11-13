<?php
declare(strict_types=1);

namespace SymfonyCon\Mastermind\Game;

use PHPUnit\Framework\TestCase;

class FeedbackTest extends TestCase
{
    public function test_it_exposes_guess_code_and_exact_and_colour_hits()
    {
        $guessCode = $this->prophesize(Code::class)->reveal();
        $exactHits = 2;
        $colourOnlyHits = 1;

        $feedback = new Feedback($guessCode, $exactHits, $colourOnlyHits);

        $this->assertSame($guessCode, $feedback->guessCode());
        $this->assertSame($exactHits, $feedback->exactHits());
        $this->assertSame($colourOnlyHits, $feedback->colourHits());
    }
}
