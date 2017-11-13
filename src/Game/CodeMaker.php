<?php
declare(strict_types = 1);

namespace SymfonyCon\Mastermind\Game;

interface CodeMaker
{
    public function newCode(int $length): Code;
}
