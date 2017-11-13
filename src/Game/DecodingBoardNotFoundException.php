<?php
declare(strict_types = 1);

namespace SymfonyCon\Mastermind\Game;

use RuntimeException;

class DecodingBoardNotFoundException extends RuntimeException implements Exception
{
    public function __construct(GameUuid $uuid, \Exception $previous = null)
    {
        parent::__construct(sprintf('Decoding board not found for the game: "%s".', $uuid), 0, $previous);
    }
}
