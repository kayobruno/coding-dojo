<?php

declare(strict_types=1);

namespace Tests;

use App\Example;
use PHPUnit\Framework\TestCase;

class ExampleTest extends TestCase
{
    public function test_Example_PingPong(): void
    {
        $example = new Example();
        $this->assertEquals('pong', $example->ping());
    }
}