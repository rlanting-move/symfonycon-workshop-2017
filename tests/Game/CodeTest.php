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

    /**
     * @dataProvider provideColourAndPositionHits
     */
    public function test_exactHits_counts_colour_and_position_hits($codeString, $anotherCodeString, $expectedHits)
    {
        $code = Code::fromString($codeString);
        $anotherCode = Code::fromString($anotherCodeString);

        $hits = $code->exactHits($anotherCode);

        $this->assertSame($expectedHits, $hits);
    }

    public function provideColourAndPositionHits()
    {
        return [
            [
                'Red Green Yellow Blue',
                'Purple Purple Purple Purple',
                0,
            ],
            [
                'Red Green Yellow Blue',
                'Red Purple Purple Purple',
                1,
            ],
            [
                'Red Green Yellow Blue',
                'Red Green Purple Purple',
                2,
            ],
            [
                'Red Green Yellow Blue',
                'Red Green Yellow Blue',
                4,
            ],
        ];
    }

    /**
     * @dataProvider provideColourOnlyHits
     */
    public function test_colourHits_counts_colour_only_hits($codeString, $anotherCodeString, $expectedHits)
    {
        $code = Code::fromString($codeString);
        $anotherCode = Code::fromString($anotherCodeString);

        $hits = $code->colourHits($anotherCode);

        $this->assertSame($expectedHits, $hits);
    }

    public function provideColourOnlyHits()
    {
        return [
            [
                'Red Green Yellow Blue',
                'Purple Purple Purple Purple',
                0,
            ],
            [
                'Red Green Yellow Blue',
                'Purple Red Purple Purple',
                1,
            ],
            [
                'Red Green Yellow Blue',
                'Red Purple Purple Purple',
                0,
            ],
            [
                'Red Green Yellow Blue',
                'Red Red Purple Purple',
                0,
            ],
            [
                'Red Green Yellow Blue',
                'Green Red Purple Purple',
                2,
            ],
            [
                'Red Green Yellow Blue',
                'Purple Red Red Red',
                1,
            ],
            [
                'Red Red Red Yellow',
                'Red Green Purple Purple',
                0
            ],
            [
                'Red Red Blue Yellow',
                'Purple Purple Red Red',
                2
            ],
            [
                'Yellow Red Red Red',
                'Purple Purple Purple Red',
                0
            ],
            [
                'Red Red Blue Yellow',
                'Purple Purple Red Purple',
                1
            ],
        ];
    }
}
