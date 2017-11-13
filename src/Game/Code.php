<?php
declare(strict_types=1);

namespace SymfonyCon\Mastermind\Game;

class Code
{
    /**
     * @var CodePeg[]
     */
    private $codePegs;

    /**
     * @param CodePeg[] $codePegs
     */
    private function __construct(array $codePegs)
    {
        $this->codePegs = $codePegs;
    }

    public static function fromString(string $codeString): Code
    {
        return self::fromColours(explode(' ', $codeString));
    }

    /**
     * @param string[] $colours
     * @return Code
     */
    public static function fromColours(array $colours): Code
    {
        return new self(
            array_map(
                function (string $colour) {
                    return new CodePeg($colour);
                },
                $colours
            )
        );
    }

    /**
     * @return CodePeg[]
     */
    public function pegs(): array
    {
        return $this->codePegs;
    }

    public function exactHits(Code $anotherCode): int
    {
        $hits = 0;

        foreach ($this->codePegs as $position => $codePeg) {
            if ($anotherCode->hasSamePegOnPosition($position, $codePeg)) {
                $hits = $hits + 1;
            }
        }

        return $hits;
    }

    private function hasSamePegOnPosition(int $position, CodePeg $codePeg): bool
    {
        return $this->codePegs[$position]->equals($codePeg);
    }
}
