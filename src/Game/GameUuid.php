<?php
declare(strict_types=1);

namespace SymfonyCon\Mastermind\Game;

class GameUuid
{
    /**
     * @var string
     */
    private $uuid;

    private function __construct(string $uuid)
    {
        $this->uuid = $uuid;
    }

    public static function existing(string $uuid): GameUuid
    {
        return new GameUuid($uuid);
    }

    public function __toString(): string
    {
        return $this->uuid;
    }
}
