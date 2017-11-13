<?php
declare(strict_types=1);

namespace SymfonyCon\Mastermind\Game;

class GameUuid
{
    public static function existing($string)
    {
        return new GameUuid();
    }

    public function __toString(): string
    {
        return '';
    }
}
