<?php
declare(strict_types=1);

namespace SymfonyCon\Mastermind\Game;

class DecodingBoard
{
    public function lastFeedback()
    {
        return new Feedback();
    }
}
