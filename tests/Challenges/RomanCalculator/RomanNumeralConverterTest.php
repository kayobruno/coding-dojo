<?php

namespace Tests\Challenges\RomanCalculator;

use App\Challenges\RomanCalculator\NumeralConverter;
use App\Challenges\RomanCalculator\RomanNumeralConverter;
use PHPUnit\Framework\TestCase;

class RomanNumeralConverterTest extends TestCase
{
    private NumeralConverter $romanNumeralConverter;

    public function setUp(): void
    {
        $this->romanNumeralConverter = new RomanNumeralConverter();
    }

    public function test_RomanNumeralConverter_ShouldThrowExceptionWhenArabicValueIsInvalid(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->romanNumeralConverter->convertArabicToRomanNumeral(-30);
    }

    public function provideValidRomanNumerals(): \Generator
    {
        yield '1 => I' => [$arabicNumeral = '1', $romanNumeral = 'I'];
        yield '3 => III' => [$arabicNumeral = '3', $romanNumeral = 'III'];
        yield '4 => IV' => [$arabicNumeral = '4', $romanNumeral = 'IV'];
        yield '5 => V' => [$arabicNumeral = '5', $romanNumeral = 'V'];
        yield '9 => IX' => [$arabicNumeral = '9', $romanNumeral = 'IX'];
        yield '10 => X' => [$arabicNumeral = '10', $romanNumeral = 'X'];
        yield '20 => XX' => [$arabicNumeral = '20', $romanNumeral = 'XX'];
        yield '40 => XL' => [$arabicNumeral = '40', $romanNumeral = 'XL'];
        yield '50 => L' => [$arabicNumeral = '50', $romanNumeral = 'L'];
        yield '90 => XC' => [$arabicNumeral = '90', $romanNumeral = 'XC'];
        yield '100 => C' => [$arabicNumeral = '100', $romanNumeral = 'C'];
        yield '400 => CD' => [$arabicNumeral = '400', $romanNumeral = 'CD'];
        yield '500 => D' => [$arabicNumeral = '500', $romanNumeral = 'D'];
        yield '900 => CM' => [$arabicNumeral = '900', $romanNumeral = 'CM'];
        yield '1000 => M' => [$arabicNumeral = '1000', $romanNumeral = 'M'];
    }

    /**
     * @dataProvider provideValidRomanNumerals
     */
    public function test_RomanNumeralConverter_ShouldConvertArabicNumeralToRomanNumeral(string $arabicNumeral, string $romanNumeral): void
    {
        $result = $this->romanNumeralConverter->convertArabicToRomanNumeral($arabicNumeral);
        $this->assertEquals($romanNumeral, $result);
    }

    /**
     * @dataProvider provideValidRomanNumerals
     */
    public function test_RomanNumeralConverter_ShouldConvertRomanNumeralToArabicNumeral(string $arabicNumeral, string $romanNumeral): void
    {
        $result = $this->romanNumeralConverter->convertRomanToArabicNumeral($romanNumeral);
        $this->assertEquals($arabicNumeral, $result);
    }
}
