<?php

declare(strict_types=1);

namespace App\Challenges\DocumentValidationRefactor;

class CpfValidator extends DocumentValidator
{
    public function isValid(string $document): bool
    {
        $document = $this->removeMask($document);
        $digits = substr($document, 0, 9);

        $newDocument = $this->calculateDigitPosition($digits);
        $newDocument = $this->calculateDigitPosition($newDocument, 11);

        return $document === $newDocument && $this->isSequenceValid($newDocument, $length = 11);
    }
}
