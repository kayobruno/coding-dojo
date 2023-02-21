<?php

declare(strict_types=1);

namespace App\Challenges\DocumentValidationRefactor;

class CnpjValidator extends DocumentValidator
{
    public function isValid(string $document): bool
    {
        $document = $this->removeMask($document);
        $digits = substr($document, 0, 12);

        $firstCalc = $this->calculateDigitPosition($digits, $positions = 5);
        $newDocument = $this->calculateDigitPosition($firstCalc, $positions = 6);

        return $newDocument === $document && $this->isSequenceValid($document, $length = 14);
    }
}
