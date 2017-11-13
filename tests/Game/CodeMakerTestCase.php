<?php
declare(strict_types=1);

namespace SymfonyCon\Mastermind\Game;

use PHPUnit\Framework\TestCase;

abstract class CodeMakerTestCase extends TestCase
{
    /**
     * @var CodeMaker
     */
    protected $codeMaker;

    protected function setUp()
    {
        $this->codeMaker = $this->createCodeMaker();
    }

    abstract protected function createCodeMaker(): CodeMaker;

    public function test_it_is_a_code_maker()
    {
        $this->assertInstanceOf(CodeMaker::class, $this->codeMaker);
    }

    public function test_it_returns_a_code_of_given_length()
    {
        $code = $this->codeMaker->newCode(3);

        $this->assertInstanceOf(Code::class, $code);
        $this->assertSame(3, $code->length());
    }
}
