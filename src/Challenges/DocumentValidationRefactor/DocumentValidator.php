<?php

declare(strict_types=1);

namespace App\Challenges\DocumentValidationRefactor;

abstract  class DocumentValidator
{
    protected const PATTERN_TO_REMOVE_MASK = '/[^0-9]/';

    abstract public function isValid(string $document): bool;

    protected function calculateDigitPosition(string $digits, int $positions = 10, int $sumDigits = 0): string
    {
        for ($i = 0; $i < strlen($digits); $i++) {
            $sumDigits = $sumDigits + ($digits[$i] * $positions);
            $positions--;

            if ($positions < 2) {
                $positions = 9;
            }
        }

        $sumDigits = $sumDigits % 11;

        if ($sumDigits < 2) {
            $sumDigits = 0;
        } else {
            $sumDigits = 11 - $sumDigits;
        }

        return $digits . $sumDigits;
    }

    protected function isSequenceValid(string $document, int $length): bool
    {
        for ($i=0; $i<10; $i++) {
            if (str_repeat((string)$i, $length) === $document) {
                return false;
            }
        }

        return true;
    }

    protected function removeMask(string $document): string
    {
        return preg_replace(self::PATTERN_TO_REMOVE_MASK, '', $document);
    }
}
