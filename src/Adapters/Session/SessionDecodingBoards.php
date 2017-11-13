<?php
declare(strict_types=1);

namespace SymfonyCon\Mastermind\Adapters\Session;

use Symfony\Component\HttpFoundation\Session\SessionInterface;
use SymfonyCon\Mastermind\Game\DecodingBoard;
use SymfonyCon\Mastermind\Game\DecodingBoardNotFoundException;
use SymfonyCon\Mastermind\Game\DecodingBoards;
use SymfonyCon\Mastermind\Game\GameUuid;

final class SessionDecodingBoards implements DecodingBoards
{
    /**
     * @var SessionInterface
     */
    private $session;

    public function __construct(SessionInterface $session)
    {
        $this->session = $session;
    }

    /**
     * @throws DecodingBoardNotFoundException
     */
    public function get(GameUuid $uuid): DecodingBoard
    {
        throw new DecodingBoardNotFoundException($uuid);
    }

    public function put(DecodingBoard $decodingBoard)
    {
    }
}
