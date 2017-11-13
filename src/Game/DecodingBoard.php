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
     * @var Feedback[]
     */
    private $feedback = [];

    public function __construct(GameUuid $gameUuid, Code $secretCode, int $numberOfAttempts)
    {
        $this->gameUuid = $gameUuid;
        $this->secretCode = $secretCode;
        $this->numberOfAttempts = $numberOfAttempts;
    }

    public function makeGuess(Code $code): Feedback
    {
        if ($this->areAnyAttemptsLeft()) {
            throw new NoAttemptsLeftException($this->numberOfAttempts);
        }

        return $this->feedback[] = new Feedback(
            $code,
            $this->secretCode->exactHits($code),
            $this->secretCode->colourHits($code)
        );
    }

    /**
     * @return Feedback[]
     */
    public function allFeedback(): array
    {
        return $this->feedback;
    }

    public function lastFeedback(): ?Feedback
    {
        return end($this->feedback) ?: null;
    }

    public function isGameWon(): bool
    {
        return null !== $this->lastFeedback() && $this->lastFeedback()->exactHits() === $this->secretCode->length();
    }

    public function isGameLost(): bool
    {
        return $this->areAnyAttemptsLeft() && !$this->isGameWon();
    }

    public function isGameFinished(): bool
    {
        return true;
    }

    private function areAnyAttemptsLeft(): bool
    {
        return count($this->feedback) >= $this->numberOfAttempts;
    }
}
