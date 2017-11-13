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
        return count($this->getPegsWithExactHits($anotherCode));
    }

    public function colourHits($anotherCode)
    {
        $hits = 0;

        foreach ($this->codePegs as $position => $codePeg) {
            foreach ($anotherCode->codePegs as $anotherPosition => $anotherCodePeg) {
                if ($codePeg->equals($anotherCodePeg) && !$anotherCode->hasSamePegOnPosition($position, $codePeg)) {
                    $hits = $hits + 1;
                }
            }
        }

        return $hits;
    }

    private function hasSamePegOnPosition(int $position, CodePeg $codePeg): bool
    {
        return $this->codePegs[$position]->equals($codePeg);
    }

    /**
     * @param Code $anotherCode
     * @return CodePeg[]
     */
    private function getPegsWithExactHits(Code $anotherCode): array
    {
        return array_filter(
            $this->codePegs,
            function (CodePeg $codePeg, int $position) use ($anotherCode) {
                return $anotherCode->hasSamePegOnPosition($position, $codePeg);
            },
            ARRAY_FILTER_USE_BOTH
        );
    }
}
