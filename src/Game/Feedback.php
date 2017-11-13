<?php
declare(strict_types=1);

namespace SymfonyCon\Mastermind\Game;

class Feedback
{
    /**
     * @var Code
     */
    private $guessCode;

    /**
     * @var int
     */
    private $exactHits;

    /**
     * @var int
     */
    private $colourHits;

    public function __construct(Code $guessCode, int $exactHits, int $colourHits)
    {
        $this->guessCode = $guessCode;
        $this->exactHits = $exactHits;
        $this->colourHits = $colourHits;
    }

    public function guessCode(): Code
    {
        return $this->guessCode;
    }

    public function exactHits(): int
    {
        return $this->exactHits;
    }

    public function colourHits(): int
    {
        return $this->colourHits;
    }
}
