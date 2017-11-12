<?php
declare(strict_types=1);

use Behat\Behat\Context\Context;
use Behat\Behat\Tester\Exception\PendingException;
use SymfonyCon\Mastermind\UseCase\StartGameUseCase;

class MastermindContext implements Context
{
    /**
     * @var int
     */
    private $numberOfAttempts = 12;

    /**
     * @var GameUuid
     */
    private $gameUuid;

    /**
     * @Given a decoding board of :numberOfAttempts attempts
     */
    public function aDecodingBoardOfGuesses($numberOfAttempts)
    {
        $this->numberOfAttempts = (int) $numberOfAttempts;
    }

    /**
     * @Given the code maker placed the :code pattern on the board
     */
    public function theCodeMakerPlacedThePatternOnTheBoard($code)
    {
        // we're not doing much with the code yet, but at some point we'll need to stub the CodeMaker to return it
        $codeLength = substr_count($code, ' ') + 1;

        $startGameUseCase = new StartGameUseCase();
        $this->gameUuid = $startGameUseCase->execute($codeLength);
    }

    /**
     * @When I try to break the code with :code
     */
    public function iTryToBreakTheCodeWith($code)
    {
        $makeGuessUseCase = new MakeGuessUseCase();
        $makeGuessUseCase->execute($this->gameUuid, Code::fromString($code));
    }

    /**
     * @Then the code maker should give me :feedback feedback on my guess
     */
    public function theCodeMakerShouldGiveMeFeedbackOnMyGuess($feedback)
    {
        throw new PendingException();
    }

    /**
     * @When I try to break the code with an invalid pattern :number times
     */
    public function iTryToBreakTheCodeWithAnInvalidPatternTimes($number)
    {
        throw new PendingException();
    }

    /**
     * @When I break the code in the final guess
     */
    public function iBreakTheCodeInTheFinalGuess()
    {
        throw new PendingException();
    }

    /**
     * @Then I should win the game
     */
    public function iShouldWinTheGame()
    {
        throw new PendingException();
    }

    /**
     * @Then I should loose the game
     */
    public function iShouldLooseTheGame()
    {
        throw new PendingException();
    }
}
