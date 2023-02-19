<?php

declare(strict_types=1);

namespace Tests\Challenges\DocumentValidationRefactor;

use App\Challenges\DocumentValidationRefactor\ValidaCPFCNPJ;
use PHPUnit\Framework\TestCase;

class ValidaCPFCNPJTest extends TestCase
{
    public function provideValidDocuments(): \Generator
    {
        yield 'CPF with mask' => ['document' => '362.883.161-05'];
        yield 'CPF without mask' => ['document' => '31445078228'];
        yield 'CNPJ with mask' => ['document' => '14.214.877/0001-90'];
        yield 'CNPJ without mask' => ['document' => '11575616000107'];
    }

    public function provideInvalidDocuments(): \Generator
    {
        yield 'CPF with mask' => ['document' => '999.883.222-05'];
        yield 'CPF without mask' => ['document' => '00045078299'];
        yield 'CPF with invalid length' => ['document' => '000450'];
        yield 'CPF with repeated numbers' => ['document' => '11111111111'];
        yield 'CNPJ with mask' => ['document' => '00.214.999/9999-00'];
        yield 'CNPJ without mask' => ['document' => '00575999000001'];
        yield 'CNPJ with invalid length' => ['document' => '9991575616000107'];
        yield 'CNPJ with repeated numbers' => ['document' => '99999999999999'];
    }

    public function provideDocumentsWithMask(): \Generator
    {
        yield 'CPF' => ['document' => '36288316105', 'expectedValue' => '362.883.161-05'];
        yield 'CNPJ' => ['document' => '14214877000190', 'expectedValue' => '14.214.877/0001-90'];
    }

    /**
     * @dataProvider provideValidDocuments
     */
    public function test_DocumentValidation_ShouldReturnTrueWhenDocumentIsValid(string $document): void
    {
        $documentValidator = new ValidaCPFCNPJ($document);

        $this->assertTrue($documentValidator->valida());
    }

    /**
     * @dataProvider provideInvalidDocuments
     */
    public function test_DocumentValidation_ShouldReturnFalseWhenDocumentIsInvalid(string $document): void
    {
        $documentValidator = new ValidaCPFCNPJ($document);

        $this->assertFalse($documentValidator->valida());
    }

    /**
     * @dataProvider provideDocumentsWithMask
     */
    public function test_DocumentValidation_ShouldAddCorrectMaskToDocument(string $document, string $expectedValue): void
    {
        $documentValidator = new ValidaCPFCNPJ($document);
        $result = $documentValidator->formata();

        $this->assertEquals($expectedValue, $result);
    }
}
