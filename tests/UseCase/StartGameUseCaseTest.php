<?php
declare(strict_types=1);

namespace SymfonyCon\Mastermind\UseCase;

use PHPUnit\Framework\TestCase;

class StartGameUseCaseTest extends TestCase
{
    public function test_it_is_initialized()
    {
        $this->assertInstanceOf(StartGameUseCase::class, new StartGameUseCase());
    }
}
