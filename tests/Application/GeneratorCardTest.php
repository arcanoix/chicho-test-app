<?php

namespace App\Test\Application;

use App\Application\GeneratorCard;
use PHPUnit\Framework\TestCase;

class GeneratorCardTest extends TestCase
{
    /** @var array */
    private $cardArray;

    public function setUp()
    {
        $cardGenerator = new GeneratorCard();

        $this->cardArray = $cardGenerator->generate()->toArray();

        parent::setUp();
    }

    public function testColumnBShouldContainNumbersLessOrEqualThan15()
    {
        for ($i = 1; $i <= 5; $i++) {
            $this->assertLessThanOrEqual(15, $this->cardArray['B'][$i]);
        }
    }

    public function testColumnIShouldContainNumbersGreaterOrEqualThan16AndLessOrEqualThan30()
    {
        for ($i = 1; $i <= 5; $i++) {
            $this->assertGreaterThanOrEqual(16, $this->cardArray['I'][$i]);
            $this->assertLessThanOrEqual(30, $this->cardArray['I'][$i]);
        }
    }

    public function testColumnsShouldContainUniqueNumbers()
    {
        foreach ($this->cardArray['B'] as $key => $value) {
            $column = $this->cardArray['B'];
            unset($column[$key]);
            $this->assertNotContains($value, $column);
        }

        foreach ($this->cardArray['I'] as $key => $value) {
            $column = $this->cardArray['I'];
            unset($column[$key]);
            $this->assertNotContains($value, $column);
        }
    }

    public function testShouldHaveOneFreeSpaceInTheMiddle()
    {
        $this->assertIsNotNumeric($this->cardArray['N'][3]);
    }
}
