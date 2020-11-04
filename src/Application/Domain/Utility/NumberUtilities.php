<?php

namespace App\Utility;

class NumberUtilities
{
    public static function randomUniqueNumber($lowerBound, $upperBound, $excludedNumbers): int
    {
        do {
            $number = random_int($lowerBound, $upperBound);
        } while (in_array($number, $excludedNumbers));

        return $number;
    }
}
