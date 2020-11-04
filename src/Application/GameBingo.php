<?php

namespace App\Application;

use App\Domain\Dto\Card;

class GameBingo
{
    /** @var CardGenerator */
    private $cardGenerator;

    /** @var Caller */
    private $caller;

    public function __construct()
    {
        $this->cardGenerator = new GeneratorCard();
        $this->caller = new Caller();
    }

    public function generateCard(): Card
    {
        return $this->cardGenerator->generate();
    }

    public function isWinningCard(Card $card, array $drawnNumbers = []): bool
    {
        if (empty($drawnNumbers)) {
            $drawnNumbers = $this->caller->getDrawnNumbers();
        }

        $isWinner = true;
        foreach ($card->toArray() as $column) {
            foreach ($column as $row => $number) {
                if (is_numeric($number) && !in_array($number, $drawnNumbers)) {
                    $isWinner = false;
                }
            }
        }
        return $isWinner;
    }
}
