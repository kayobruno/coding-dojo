<?php

declare(strict_types=1);

namespace Tests\Challenges\DocumentValidationRefactor;

use App\Challenges\DocumentValidationRefactor\CnpjValidator;
use App\Challenges\DocumentValidationRefactor\CpfValidator;
use App\Challenges\DocumentValidationRefactor\ValidaCPFCNPJ;
use PHPUnit\Framework\TestCase;

class ValidaCPFCNPJTest extends TestCase
{
    public function provideValidCpf(): \Generator
    {
        yield 'CPF with mask' => ['document' => '362.883.161-05'];
        yield 'CPF without mask' => ['document' => '31445078228'];
    }

    public function provideValidCnpj(): \Generator
    {
        yield 'CNPJ with mask' => ['document' => '14.214.877/0001-90'];
        yield 'CNPJ without mask' => ['document' => '11575616000107'];
    }

    public function provideInvalidCpf(): \Generator
    {
        yield 'CPF with mask' => ['document' => '999.883.222-05'];
        yield 'CPF without mask' => ['document' => '00045078299'];
        yield 'CPF with invalid length' => ['document' => '000450'];
        yield 'CPF with repeated numbers' => ['document' => '11111111111'];
    }

    public function provideInvalidCnpj(): \Generator
    {
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
     * @dataProvider provideValidCpf
     */
    public function test_DocumentValidation_ShouldReturnTrueWhenCpfIsValid(string $document): void
    {
        $documentValidator = new CpfValidator();

        $this->assertTrue($documentValidator->isValid($document));
    }

    /**
     * @dataProvider provideValidCnpj
     */
    public function test_DocumentValidation_ShouldReturnTrueWhenCnpjIsValid(string $document): void
    {
        $documentValidator = new CnpjValidator();

        $this->assertTrue($documentValidator->isValid($document));
    }

    /**
     * @dataProvider provideInvalidCpf
     */
    public function test_DocumentValidation_ShouldReturnFalseWhenCpfIsInvalid(string $document): void
    {
        $documentValidator = new CpfValidator();

        $this->assertFalse($documentValidator->isValid($document));
    }

    /**
     * @dataProvider provideInvalidCnpj
     */
    public function test_DocumentValidation_ShouldReturnFalseWhenCnpjIsInvalid(string $document): void
    {
        $documentValidator = new CnpjValidator();

        $this->assertFalse($documentValidator->isValid($document));
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
