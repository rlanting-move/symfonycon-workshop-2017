<?php

use Behat\Behat\Context\Context;
use Behat\Behat\Tester\Exception\PendingException;

class MastermindContext implements Context
{
    /**
     * @Given a decoding board of :numberOfAttempts attempts
     */
    public function aDecodingBoardOfGuesses($numberOfAttempts)
    {
        throw new PendingException();
    }

    /**
     * @Given the code maker placed the :code pattern on the board
     */
    public function theCodeMakerPlacedThePatternOnTheBoard($code)
    {
    }

    /**
     * @When I try to break the code with :code
     */
    public function iTryToBreakTheCodeWith($code)
    {
        throw new PendingException();
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
