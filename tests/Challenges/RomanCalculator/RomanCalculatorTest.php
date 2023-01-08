<?php

declare(strict_types=1);

namespace Tests\Challenges\RomanCalculator;

use App\Challenges\RomanCalculator\RomanCalculator;
use App\Challenges\RomanCalculator\RomanNumeralConverter;
use PHPUnit\Framework\TestCase;

class RomanCalculatorTest extends TestCase
{
    private RomanCalculator $calculator;

    public function setUp(): void
    {
        $this->calculator = new RomanCalculator(new RomanNumeralConverter());
    }

    public function test_RomanCalculator_ShouldThrowExceptionWhenValueIsIncorrect(): void
    {
        $this->expectException(\Exception::class);
        $this->calculator->sum('IIII', 'I');
    }

    public function providerInputsToSum(): \Generator
    {
        yield 'I + I = II' => [$inputOne = 'I', $inputTwo = 'I', $result = 'II'];
        yield 'I + III = IV' => [$inputOne = 'I', $inputTwo = 'III', $result = 'IV'];
        yield 'VI + III = IX' => [$inputOne = 'III', $inputTwo = 'VI', $result = 'IX'];
        yield 'MMMDCCXXIV + LXXVIII = MMMDCCCII' => [$inputOne = 'MMMDCCXXIV', $inputTwo = 'LXXVIII', $result = 'MMMDCCCII'];
        yield 'L + L = C' => [$inputOne = 'L', $inputTwo = 'L', $result = 'C'];
        yield 'XIX + XL = C' => [$inputOne = 'XIX', $inputTwo = 'XL', $result = 'LIX'];
        yield 'V + IV = IX' => [$inputOne = 'V', $inputTwo = 'IV', $result = 'IX'];
        yield 'CXLIX + IV = CLIII' => [$inputOne = 'CXLIX', $inputTwo = 'IV', $result = 'CLIII'];
        yield 'MMMCDXLIX + MMMCDXLIX = (V)MDCCCXCVIII' => [$inputOne = 'MMMCDXLIX', $inputTwo = 'MMMCDXLIX', $result = '(V)MDCCCXCVIII'];
    }

    /**
     * @dataProvider providerInputsToSum
     */
    public function test_RomanCalculator_ShouldSumCorrectly(string $inputOne, string $inputTwo, string $expectedResult): void
    {
        $result = $this->calculator->sum($inputOne, $inputTwo);
        $this->assertEquals($expectedResult, $result);
    }
}


