<?php

require __DIR__.'/vendor/autoload.php';

use App\Application\Caller;
use App\Application\GameBingo;
use App\Application\GeneratorCard;

try {

        $cardGenerator = new GeneratorCard();
        $callers = new Caller();

        $bingo = new GameBingo();
        $card = $bingo->generateCard();
        $numbers = [];

        for ($i = 0; $i < 75; $i++) {
            array_push($numbers, $callers->draw());
        }

        
        $isWin =  $bingo->isWinningCard($card, $numbers);
        var_dump($isWin);
    
} catch (\Exception $exception) {
    return $exception->getMessage();
}