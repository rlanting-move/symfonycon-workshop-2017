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
        return new self(
            array_map(
                function (string $colour) {
                    return new CodePeg($colour);
                },
                explode(' ', $codeString)
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
}
