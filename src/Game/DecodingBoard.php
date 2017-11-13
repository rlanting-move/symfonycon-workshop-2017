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

    /**
     * @var int
     */
    private $attemptsUsed = 0;

    public function __construct(GameUuid $gameUuid, Code $secretCode, int $numberOfAttempts)
    {
        $this->gameUuid = $gameUuid;
        $this->secretCode = $secretCode;
        $this->numberOfAttempts = $numberOfAttempts;
    }

    public function makeGuess(Code $code): Feedback
    {
        if ($this->attemptsUsed >= $this->numberOfAttempts) {
            throw new NoAttemptsLeftException($this->numberOfAttempts);
        }

        $this->attemptsUsed++;

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
