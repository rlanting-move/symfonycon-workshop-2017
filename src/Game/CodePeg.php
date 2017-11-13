<?php
declare(strict_types=1);

namespace SymfonyCon\Mastermind\Game;

class CodePeg
{
    /**
     * @var string
     */
    private $colour;

    public function __construct(string $colour)
    {
        $this->colour = $colour;
    }

    public function __toString(): string
    {
        return $this->colour;
    }

    public function equals($anotherCodePeg)
    {
        return true;
    }
}
