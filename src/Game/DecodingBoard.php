<?php
declare(strict_types=1);

namespace SymfonyCon\Mastermind\Game;

class DecodingBoard
{
    /**
     * @var GameUuid
     */
    private $gameUuid;

    /**
     * @var Code
     */
    private $secretCode;

    /**
     * @var int
     */
    private $numberOfAttempts;

    public function __construct(GameUuid $gameUuid, Code $secretCode, int $numberOfAttempts)
    {
        $this->gameUuid = $gameUuid;
        $this->secretCode = $secretCode;
        $this->numberOfAttempts = $numberOfAttempts;
    }

    public function makeGuess(Code $code)
    {
        return new Feedback(
            $code,
            $this->secretCode->exactHits($code),
            $this->secretCode->colourHits($code)
        );
    }

    public function lastFeedback()
    {
        return new Feedback(Code::fromString('Red'), 0, 0);
    }
}
