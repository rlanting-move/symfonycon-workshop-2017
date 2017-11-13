<?php
declare(strict_types=1);

namespace SymfonyCon\Mastermind\UseCase;

use PHPUnit\Framework\TestCase;
use Prophecy\Argument;
use Prophecy\Prophecy\ObjectProphecy;
use SymfonyCon\Mastermind\Game\Code;
use SymfonyCon\Mastermind\Game\CodeMaker;
use SymfonyCon\Mastermind\Game\DecodingBoard;
use SymfonyCon\Mastermind\Game\DecodingBoards;

class StartGameUseCaseTest extends TestCase
{
    const NUMBER_OF_ATTEMPTS = 12;
    const CODE_LENGTH = 4;

    /**
     * @var StartGameUseCase
     */
    private $useCase;

    /**
     * @var DecodingBoards|ObjectProphecy
     */
    private $boards;

    /**
     * @var CodeMaker|ObjectProphecy
     */
    private $codeMaker;

    protected function setUp()
    {
        $this->boards = $this->prophesize(DecodingBoards::class);
        $this->codeMaker = $this->prophesize(CodeMaker::class);
        $this->useCase = new StartGameUseCase(
            $this->boards->reveal(),
            $this->codeMaker->reveal(),
            self::NUMBER_OF_ATTEMPTS
        );
    }

    public function test_it_stores_a_new_decoding_board()
    {
        $this->codeMaker->newCode(self::CODE_LENGTH)->willReturn($this->getCode());

        $this->useCase->execute(self::CODE_LENGTH);

        $this->boards->put(Argument::type(DecodingBoard::class))->shouldHaveBeenCalled();
    }

    private function getCode(): Code
    {
        return $this->prophesize(Code::class)->reveal();
    }
}
