<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;

class ExampleTest extends TestCase
{
    /**
     * @test
     */
    public function itTests()
    {
        $this->assertIsString('test', 'test failed');
    }
}