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

    public static function fromString($codeString)
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

    public function pegs()
    {
        return $this->codePegs;
    }
}
