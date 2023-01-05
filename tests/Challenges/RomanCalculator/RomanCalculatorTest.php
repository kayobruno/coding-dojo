<?php

declare(strict_types=1);

namespace Tests\Challenges\RomanCalculator;

use App\Challenges\RomanCalculator\RomanCalculator;
use PHPUnit\Framework\TestCase;

class RomanCalculatorTest extends TestCase
{
    public function test_RomanCalculator_ShouldThrowExceptionWhenValueIsIncorrect(): void
    {
        $this->expectException(\Exception::class);

        $romanCalculator = new RomanCalculator();
        $romanCalculator->sum('IIII', 'I');
    }
}


