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

    public function providerMapperNumerals(): \Generator
    {
        yield '1 = I' => [$arabicNumeral = 1, $romanNumeral = 'I'];
        yield '5 = V' => [$arabicNumeral = 5, $romanNumeral = 'V'];
        yield '10 = X' => [$arabicNumeral = 10, $romanNumeral = 'X'];
        yield '50 = L' => [$arabicNumeral = 50, $romanNumeral = 'L'];
        yield '100 = C' => [$arabicNumeral = 100, $romanNumeral = 'C'];
        yield '500 = D' => [$arabicNumeral = 500, $romanNumeral = 'D'];
        yield '1000 = M' => [$arabicNumeral = 1000, $romanNumeral = 'M'];
    }

    /**
     * @dataProvider providerMapperNumerals
     */
    public function test_RomanCalculator_ShouldConvertArabicNumeralToRomanNumeral(int $arabicNumeral, string $romanNumeral): void
    {
        $romanCalculator = new RomanCalculator();
        $result = $romanCalculator->convertArabicNumeralToRomanNumeral($arabicNumeral);

        $this->assertEquals($romanNumeral, $result);
    }

    public function providerRomanNumerals(): \Generator
    {
        yield 'MMMDCCXXIV = 3724' => [$arabicNumeral = 3724, $romanNumeral = 'MMMDCCXXIV'];
        yield 'LXXVIII = 98' => [$arabicNumeral = 98, $romanNumeral = 'LXXVIII'];
        yield 'DCCCC = 900' => [$arabicNumeral = 900, $romanNumeral = 'DCCCC'];
        yield 'MDCCLXXIV = 1774' => [$arabicNumeral = 1774, $romanNumeral = 'MDCCLXXIV'];
    }

    /**
     * @dataProvider providerRomanNumerals
     */
    public function test_RomanCalculator_ShouldConvertRomanNumeralToArabicNumeral(): void
    {
        $romanCalculator = new RomanCalculator();
        $result = $romanCalculator->convertRomanNumeralToArabicNumeral('MMMDCCXXIV');

        $this->assertEquals(3724, $result);
    }
}


