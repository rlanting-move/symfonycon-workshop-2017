<?php
declare(strict_types=1);

namespace SymfonyCon\Mastermind\Game;

class RandomCodeMakerTest extends CodeMakerTestCase
{
    protected function createCodeMaker(): CodeMaker
    {
        return new RandomCodeMaker();
    }
}
