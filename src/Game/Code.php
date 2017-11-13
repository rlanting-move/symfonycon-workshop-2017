<?php
declare(strict_types=1);

namespace SymfonyCon\Mastermind\Game;

class Code
{
    public static function fromString($codeString)
    {
        return new self();
    }

    public function pegs()
    {
        return [];
    }
}
