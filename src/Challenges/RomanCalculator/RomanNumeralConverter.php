<?php

namespace App\Challenges\RomanCalculator;

class RomanNumeralConverter implements NumeralConverter
{
    public function convertArabicToRomanNumeral(string $number): string
    {
        $this->validateNumeral($number);

        $romanNumeral = '';
        $mapper = $this->numeralMapper();

        while ($number > 0) {
            foreach ($mapper as $key => $value) {
                if ($number >= $value) {
                    $romanNumeral .= $key;
                    $number -= $value;
                    break;
                }
            }
        }

        return $romanNumeral;
    }

    public function convertRomanToArabicNumeral(string $number): string
    {
        $numeralMapper = $this->numeralMapper();
        $romanNumerals = str_split(strrev($number));

        $arabicNumeral = 0;
        $lastNumeral = '';
        foreach ($romanNumerals as $romanNumeral) {
            if (!isset($numeralMapper[$romanNumeral])) {
                continue;
            }

            if ($lastNumeral !== '' && $numeralMapper[$romanNumeral] < $numeralMapper[$lastNumeral]) {
                $arabicNumeral -= $numeralMapper[$romanNumeral];
                $lastNumeral = $romanNumeral;
                continue;
            }

            $arabicNumeral += $numeralMapper[$romanNumeral];
            $lastNumeral = $romanNumeral;
        }

        return $arabicNumeral;
    }

    public function numeralMapper(): array
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
            'IV' => 4,
            'I' => 1,
        ];
    }

    public function validateNumeral(string $value): void
    {
        if ($value <= 0 || is_float($value)) {
            throw new \InvalidArgumentException("The value {$value} is invalid!");
        }
    }
}
