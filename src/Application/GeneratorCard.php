<?php

namespace App\Application;

use App\Domain\Dto\Card;
use App\Utility\NumberUtilities;

class GeneratorCard
{
    /** @var array */
    private $columns;

    /** @var int */
    private $rows;

    /** @var int */
    private $maxNumber;

    /** @var array */
    private $freeSpaces;

    public const FREE = 'FREE';

    public function __construct(
        array $columns = ['B','I','N','G','O'],
        int $rows = 5,
        int $maxNumber = 75,
        array $freeSpaces = ['column' => 'N', 'row' => 3]
    ) {
        $this->columns = $columns;
        $this->rows = $rows;
        $this->maxNumber = $maxNumber;
        $this->freeSpaces = $freeSpaces;
    }

    public function generate(): Card
    {
        $card = [];

        $range = $this->maxNumber / count($this->columns);

        foreach ($this->columns as $row => $column) {
            $lowerBound = ($row + 1) * $range - ($range - 1);
            $upperBound = ($row + 1) * $range;

            for ($i = 1; $i <= $this->rows; $i++) {
                $excludedNumbers = !empty($card[$column]) ? array_values($card[$column]) : [];

                $card[$column][$i] = NumberUtilities::randomUniqueNumber(
                    $lowerBound,
                    $upperBound,
                    $excludedNumbers
                );
            }
        }

        $card[$this->freeSpaces['column']][$this->freeSpaces['row']] = self::FREE;

        return new Card($card);
    }
}
