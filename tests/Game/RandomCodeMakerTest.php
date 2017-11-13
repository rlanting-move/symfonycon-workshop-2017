<?php
declare(strict_types=1);

namespace SymfonyCon\Mastermind\Game;

use PHPUnit\Framework\TestCase;

class RandomCodeMakerTest extends TestCase
{
    /**
     * @var CodeMaker
     */
    protected $codeMaker;

    protected function setUp()
    {
        $this->codeMaker = new RandomCodeMaker();
    }

    public function test_it_is_a_code_maker()
    {
        $this->assertInstanceOf(CodeMaker::class, $this->codeMaker);
    }
}
