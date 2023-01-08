<?php

namespace App\Challenges\RomanCalculator;

interface NumeralConverter
{
    public function numeralMapper(): array;
    public function validateNumeral(string $value): void;
}
