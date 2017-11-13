<?php
declare(strict_types=1);

namespace SymfonyCon\Mastermind\Game;

class CodePeg
{
    const AVAILABLE_COLOURS = ['Red', 'Green', 'Blue', 'Yellow', 'Purple'];

    /**
     * @var string
     */
    private $colour;

    public function __construct(string $colour)
    {
        if (!in_array($colour, self::AVAILABLE_COLOURS)) {
            throw new UnknownColourException($colour, self::AVAILABLE_COLOURS);
        }

        $this->colour = $colour;
    }

    public function __toString(): string
    {
        return $this->colour;
    }

    public function equals(CodePeg $anotherCodePeg): bool
    {
        return $this->colour === $anotherCodePeg->colour;
    }
}
