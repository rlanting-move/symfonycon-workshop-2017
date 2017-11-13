<?php
declare(strict_types=1);

namespace SymfonyCon\Mastermind\Adapters\InMemory;

use SymfonyCon\Mastermind\Game\Code;
use SymfonyCon\Mastermind\Game\CodeMaker;
use SymfonyCon\Mastermind\Game\CodeMakerTestCase;

class InMemoryCodeMakerTest extends CodeMakerTestCase
{
    /**
     * @var Code
     */
    private $code;

    /**
     * @before
     */
    protected function createCode()
    {
        $this->code = Code::fromString('Red Green Blue');
    }

    protected function createCodeMaker(): CodeMaker
    {
        return new InMemoryCodeMaker($this->code);
    }

    public function test_it_returns_a_previously_defined_code()
    {
        $code = $this->codeMaker->newCode($this->code->length());

        $this->assertSame($this->code, $code);
    }
}
