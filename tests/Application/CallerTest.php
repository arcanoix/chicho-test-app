<?php

namespace App\Test\Application;

use App\Application\Caller;
use PHPUnit\Framework\TestCase;

class CallerTest extends TestCase
{
    /** @var Caller */
    private $caller;

    protected function setUp()
    {
        $this->caller = new Caller();

        parent::setUp();
    }

    public function testCalledNumberGreaterThan1AndLessOrEqualThan75()
    {
        $this->caller->reset();

        $number = $this->caller->draw();

        $this->assertGreaterThanOrEqual(1, $number);
        $this->assertLessThanOrEqual(75, $number);
    }

    public function testAllTheNumbersShouldHaveBeenCalled()
    {
        $this->caller->reset();

        $numbers = [];

        for ($i = 0; $i < 75; $i++) {
            array_push($numbers, $this->caller->draw());
        }

        sort($numbers);

        $allPresent = true;

        for ($i = 0; $i < 75; $i++) {
            if ($numbers[$i] != $i+1) {
                $allPresent = false;
                break;
            }
        }
        
        $this->assertTrue($allPresent);
    }
}
