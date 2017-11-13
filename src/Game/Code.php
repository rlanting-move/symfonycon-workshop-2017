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

    public function colourHits(Code $anotherCode): int
    {
        $positionsCounted = [];

        foreach ($this->getPegsWithNoExactHits($anotherCode) as $position => $codePeg) {
            foreach ($anotherCode->getPegsWithNoExactHits($this) as $anotherPosition => $anotherCodePeg) {
                if ($codePeg->equals($anotherCodePeg) && !isset($positionsCounted[$anotherPosition])) {
                    $positionsCounted[$anotherPosition] = true;

                    break;
                }
            }
        }

        return count($positionsCounted);
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

    /**
     * @param Code $anotherCode
     * @return CodePeg[]
     */
    private function getPegsWithNoExactHits(Code $anotherCode): array
    {
        return array_filter(
            $this->codePegs,
            function (CodePeg $peg, int $position) use ($anotherCode) {
                return !$anotherCode->hasSamePegOnPosition($position, $peg);
            },
            ARRAY_FILTER_USE_BOTH
        );
    }
}
