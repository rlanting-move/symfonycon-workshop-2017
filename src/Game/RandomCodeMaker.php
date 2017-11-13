<?php
declare(strict_types=1);

namespace SymfonyCon\Mastermind\Game;

final class RandomCodeMaker implements CodeMaker
{
    public function newCode(int $length): Code
    {
        $colours = array_intersect_key(
            CodePeg::AVAILABLE_COLOURS,
            array_flip(array_rand(CodePeg::AVAILABLE_COLOURS, $length))
        );

        return Code::fromString(implode(' ', $colours));
    }
}
