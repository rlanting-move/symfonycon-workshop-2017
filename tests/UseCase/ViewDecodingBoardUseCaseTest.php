<?php
declare(strict_types=1);

namespace SymfonyCon\Mastermind\UseCase;

use PHPUnit\Framework\TestCase;
use SymfonyCon\Mastermind\Game\DecodingBoard;

class ViewDecodingBoardUseCaseTest extends TestCase
{
    public function test_it_is_initialized()
    {
        $this->assertInstanceOf(ViewDecodingBoardUseCase::class, new ViewDecodingBoardUseCase());
    }

    public function test_it_returns_a_decoding_board()
    {
        $useCase = new ViewDecodingBoardUseCase();

        $board = $useCase->execute('');

        $this->assertInstanceOf(DecodingBoard::class, $board);
    }
}
