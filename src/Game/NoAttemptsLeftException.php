<?php
declare(strict_types = 1);

namespace SymfonyCon\Mastermind\Game;

class NoAttemptsLeftException extends \RuntimeException
{
    public function __construct(int $numberOfAttempts)
    {
        parent::__construct(sprintf('All of the %d attempts were already used.', $numberOfAttempts));
    }
}
