<?php
declare(strict_types=1);

namespace SymfonyCon\Mastermind\Adapters\InMemory;

use SymfonyCon\Mastermind\Game\Code;
use SymfonyCon\Mastermind\Game\CodeMaker;

final class InMemoryCodeMaker implements CodeMaker
{
    /**
     * @var Code
     */
    private $code;

    public function __construct(Code $code)
    {
        $this->code = $code;
    }

    public function newCode(int $length): Code
    {
        return $this->code;
    }
}
