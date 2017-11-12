<?php
declare(strict_types=1);

namespace SymfonyCon\Mastermind\UseCase;

use PHPUnit\Framework\TestCase;

class ViewDecodingBoardUseCaseTest extends TestCase
{
    public function test_it_is_initialized()
    {
        $this->assertInstanceOf(ViewDecodingBoardUseCase::class, new ViewDecodingBoardUseCase());
    }
}
