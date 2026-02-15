<?php

namespace SprintF\Tests\Value;

use Codeception\Test\Unit;
use SprintF\Tests\Support\UnitTester;
use SprintF\ValueObjects\Value\FractionValue;

/**
 * @internal
 *
 * @coversNothing
 */
class FractionValueTest extends Unit
{
    protected UnitTester $tester;

    public function testNull()
    {
        $value = new FractionValue(null);
        $this->assertNull($value->getValue());
    }

    public function testInvalid()
    {
        $this->expectException(\TypeError::class);
        $value = new FractionValue('foo');
    }

    public function testInteger()
    {
        $value = new FractionValue(1);
        $this->assertSame(1, $value->getValue());
        $this->assertSame('1/1', (string) $value);

        $value = new FractionValue(-1);
        $this->assertSame(-1, $value->getValue());
        $this->assertSame('-1/1', (string) $value);
    }

    public function testFiniteFloat()
    {
        $value = new FractionValue(0.5);
        $this->assertSame(0.5, $value->getValue());
        $this->assertSame('1/2', (string) $value);

        $value = new FractionValue(-0.5);
        $this->assertSame(-0.5, $value->getValue());
        $this->assertSame('-1/2', (string) $value);

        $value = new FractionValue(0.25);
        $this->assertSame(0.25, $value->getValue());
        $this->assertSame('1/4', (string) $value);

        $value = new FractionValue(-0.25);
        $this->assertSame(-0.25, $value->getValue());
        $this->assertSame('-1/4', (string) $value);
    }

    public function testInfiniteFloat()
    {
        $value = new FractionValue(M_PI);
        $this->assertSame(M_PI, $value->getValue());
        $this->assertSame('311/99', (string) $value);

        // @todo: precision!
    }
}
