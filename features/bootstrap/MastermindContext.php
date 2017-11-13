<?php
declare(strict_types=1);

use Behat\Behat\Context\Context;
use Behat\Behat\Tester\Exception\PendingException;
use PHPUnit\Framework\Assert;
use SymfonyCon\Mastermind\Adapters\InMemory\InMemoryCodeMaker;
use SymfonyCon\Mastermind\Adapters\InMemory\InMemoryDecodingBoards;
use SymfonyCon\Mastermind\Game\Code;
use SymfonyCon\Mastermind\Game\DecodingBoards;
use SymfonyCon\Mastermind\Game\Feedback;
use SymfonyCon\Mastermind\Game\GameUuid;
use SymfonyCon\Mastermind\UseCase\MakeGuessUseCase;
use SymfonyCon\Mastermind\UseCase\StartGameUseCase;
use SymfonyCon\Mastermind\UseCase\ViewDecodingBoardUseCase;

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
     * @var DecodingBoards
     */
    private $decodingBoards;

    public function __construct()
    {
        $this->decodingBoards = new InMemoryDecodingBoards();
    }

    /**
     * @Given a decoding board of :numberOfAttempts attempts
     */
    public function aDecodingBoardOfGuesses($numberOfAttempts)
    {
        $this->numberOfAttempts = (int)$numberOfAttempts;
    }

    /**
     * @Given the code maker placed the :code pattern on the board
     */
    public function theCodeMakerPlacedThePatternOnTheBoard(Code $code)
    {
        $startGameUseCase = new StartGameUseCase(
            $this->decodingBoards,
            new InMemoryCodeMaker($code),
            $this->numberOfAttempts
        );
        $this->gameUuid = $startGameUseCase->execute($code->length());
    }

    /**
     * @When I try to break the code with :code
     */
    public function iTryToBreakTheCodeWith(Code $code)
    {
        $makeGuessUseCase = new MakeGuessUseCase($this->decodingBoards);
        $makeGuessUseCase->execute($this->gameUuid, $code);
    }

    /**
     * @Then the code maker should give me :feedback feedback on my guess
     */
    public function theCodeMakerShouldGiveMeFeedbackOnMyGuess($feedback)
    {
        $viewDecodingBoardUseCase = new ViewDecodingBoardUseCase($this->decodingBoards);
        $board = $viewDecodingBoardUseCase->execute($this->gameUuid);

        Assert::assertInstanceOf(Feedback::class, $board->lastFeedback(), 'Feedback on the last guess attempt was given.');
        Assert::assertSame(substr_count($feedback, 'X'), $board->lastFeedback()->exactHits());
        Assert::assertSame(substr_count($feedback, 'O'), $board->lastFeedback()->colourHits());
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

    /**
     * @Transform :code
     */
    public function transformCodeStringToCode(string $code)
    {
        return Code::fromString($code);
    }
}
