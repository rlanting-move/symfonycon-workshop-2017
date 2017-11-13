<?php
declare(strict_types=1);

namespace SymfonyCon\Mastermind\Game;

use PHPUnit\Framework\TestCase;

class CodeTest extends TestCase
{
    public function test_it_is_created_from_a_string_of_code_pegs()
    {
        $code = Code::fromString('Red Green Blue');

        $this->assertInstanceOf(Code::class, $code);
        $this->assertEquals(
            [
                new CodePeg('Red'),
                new CodePeg('Green'),
                new CodePeg('Blue'),
            ],
            $code->pegs()
        );
    }

    public function test_it_is_created_from_an_array_of_code_peg_strings()
    {
        $code = Code::fromColours(['Red', 'Green', 'Blue']);

        $this->assertInstanceOf(Code::class, $code);
        $this->assertEquals(
            [
                new CodePeg('Red'),
                new CodePeg('Green'),
                new CodePeg('Blue'),
            ],
            $code->pegs()
        );
    }

    public function test_exactHits_counts_colour_and_position_hits()
    {
        $code = Code::fromString('Red Green Yellow Blue');
        $anotherCode = Code::fromString('Purple Purple Purple Purple');

        $hits = $code->exactHits($anotherCode);

        $this->assertSame(0, $hits);
    }
}
