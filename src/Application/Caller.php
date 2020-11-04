<?php

namespace App\Application;

use App\Utility\NumberUtilities;

class Caller
{
    /** @var array */
    private $pile = [];

    public function draw(): int
    {
        $number = NumberUtilities::randomUniqueNumber(1, 75, $this->pile);
        $this->pile[] = $number;

        return $number;
    }

    public function reset()
    {
        $this->pile = [];
    }

    public function getDrawnNumbers(): array
    {
        return $this->pile;
    }
}
