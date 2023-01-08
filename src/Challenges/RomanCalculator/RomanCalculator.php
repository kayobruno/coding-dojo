<?php

declare(strict_types=1);

namespace App\Challenges\RomanCalculator;

final class RomanCalculator
{
    private const NUMERALS_MAX_REPETITION = [
        3 => ['I', 'X', 'C', 'M'],
        1 => ['V', 'L', 'D']
    ];

    public function __construct(protected NumeralConverter $numeralConverter)
    {}

    public function sum(string $valueOne, string $valueTwo): string
    {
        $this->validateNumerals(...[$valueOne, $valueTwo]);

        $arabicNumeralInputOne = $this->numeralConverter->convertRomanToArabicNumeral($valueOne);
        $arabicNumeralInputTwo = $this->numeralConverter->convertRomanToArabicNumeral($valueTwo);

        $total = $arabicNumeralInputOne + $arabicNumeralInputTwo;

        return $this->numeralConverter->convertArabicToRomanNumeral((string) $total);
    }

    /**
     * @throws \Exception
     */
    private function validateNumerals(string $romanNumeral): void
    {
        foreach (self::NUMERALS_MAX_REPETITION as $maxRepetition => $numerals) {
            array_map(function ($value) use ($romanNumeral, $maxRepetition) {
                if (substr_count($romanNumeral, $value) > $maxRepetition) {
                    throw new \Exception("The numeral is invalid");
                }
            }, $numerals);
        }
    }
}
