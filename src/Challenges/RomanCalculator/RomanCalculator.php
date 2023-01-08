<?php

declare(strict_types=1);

namespace App\Challenges\RomanCalculator;

class RomanCalculator
{
    public function sum(string $valueOne, string $valueTwo): string
    {
        $this->validateNumerals($valueOne);
        $this->validateNumerals($valueTwo);

        return "{$valueOne}{$valueTwo}";
    }

    private function validateNumerals(string $value): void
    {
        $numeralsAndMaxRepetition = [
            'I' => 3,
            'X' => 3,
            'C' => 3,
            'V' => 1,
            'L' => 1,
            'D' => 1,
        ];

        foreach ($numeralsAndMaxRepetition as $numeral => $maxRepetition) {
            if (substr_count($value, $numeral) >= $maxRepetition) {
                throw new \Exception('The numeral is invalid');
            }
        }
    }

    private function numeralMapper(): array
    {
        return [
            'M' => 1000,
            'D' => 500,
            'C' => 100,
            'L' => 50,
            'X' => 10,
            'V' => 5,
            'I' => 1,
        ];
    }

    public function convertRomanNumeralToArabicNumeral(string $romanNumerals): int
    {
        $numeralMapper = $this->numeralMapper();
        $romanNumerals = str_split(strrev($romanNumerals));

        $arabicNumeral = 0;
        $lastNumeral = '';
        foreach ($romanNumerals as $romanNumeral) {
            if (isset($numeralMapper[$romanNumeral])) {
                if ($lastNumeral !== '' && $numeralMapper[$romanNumeral] < $numeralMapper[$lastNumeral]) {
                    $arabicNumeral -= $numeralMapper[$romanNumeral];
                    $lastNumeral = $romanNumeral;
                    continue;
                }

                $arabicNumeral += $numeralMapper[$romanNumeral];
                $lastNumeral = $romanNumeral;
            }
        }

        return $arabicNumeral;
    }

    public function convertArabicNumeralToRomanNumeral(int $arabicNumeral): string
    {
        $romanNumeral = '';
        foreach ($this->numeralMapper() as $key => $value) {
            if ($arabicNumeral >= $value) {
                $romanNumeral .= $key;
                $arabicNumeral -= $value;
            }
        }

        return $romanNumeral;
    }
}
