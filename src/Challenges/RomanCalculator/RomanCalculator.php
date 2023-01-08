<?php

declare(strict_types=1);

namespace App\Challenges\RomanCalculator;

class RomanCalculator
{
    public function sum(string $valueOne, string $valueTwo): string
    {
        $this->validateNumerals($valueOne);
        $this->validateNumerals($valueTwo);

        $arabicnumeralOne = $this->convertRomanNumeralToArabicNumeral($valueOne);
        $arabicnumeralTwo = $this->convertRomanNumeralToArabicNumeral($valueTwo);

        $total = $arabicnumeralOne + $arabicnumeralTwo;

        return $this->convertArabicNumeralToRomanNumeral($total);
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
            if (substr_count($value, $numeral) > $maxRepetition) {
                throw new \Exception("The numeral {$numeral} is invalid");
            }
        }
    }

    private function numeralMapper(): array
    {
        return [
            '(M)' => 1000000,
            '(D)' => 500000,
            '(C)' => 100000,
            '(L)' => 50000,
            '(X)' => 10000,
            '(V)' => 5000,
            'M' => 1000,
            'CM' => 900,
            'D' => 500,
            'CD' => 400,
            'C' => 100,
            'XC' => 90,
            'L' => 50,
            'XL' => 40,
            'X' => 10,
            'IX' => 9,
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
        $mapper = $this->numeralMapper();

        while ($arabicNumeral > 0) {
            foreach ($mapper as $key => $value) {
                if ($arabicNumeral >= $value) {
                    $romanNumeral .= $key;
                    $arabicNumeral -= $value;
                    break;
                }
            }
        }

        return $romanNumeral;
    }
}
