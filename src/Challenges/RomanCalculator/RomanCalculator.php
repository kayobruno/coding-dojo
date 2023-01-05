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
}
