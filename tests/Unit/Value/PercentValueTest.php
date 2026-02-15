<?php

namespace SprintF\Tests\Value;

use Codeception\Test\Unit;
use SprintF\Tests\Support\UnitTester;
use SprintF\ValueObjects\Value\PercentValue;

/**
 * @internal
 *
 * @coversNothing
 */
class PercentValueTest extends Unit
{
    protected UnitTester $tester;

    public function testNull()
    {
        $value = new PercentValue(null);
        $this->assertNull($value->getValue());
        $this->assertSame('-', (string) $value);
    }

    public function testInvalid()
    {
        $this->expectException(\TypeError::class);
        $value = new PercentValue('foo');
    }

    public function testInteger()
    {
        $value = new PercentValue(42);
        $this->assertSame(42, $value->getValue());
        $this->assertSame('42%', (string) $value);

        $value = new PercentValue(-42);
        $this->assertSame(-42, $value->getValue());
        $this->assertSame('-42%', (string) $value);
    }

    public function testFloat()
    {
        $value = new PercentValue(42.1);
        $this->assertSame(42.1, $value->getValue());
        $this->assertSame('42.1%', (string) $value);

        $value = new PercentValue(-42.1);
        $this->assertSame(-42.1, $value->getValue());
        $this->assertSame('-42.1%', (string) $value);

        $value = new PercentValue(42.12);
        $this->assertSame(42.12, $value->getValue());
        $this->assertSame('42.12%', (string) $value);

        $value = new PercentValue(-42.12);
        $this->assertSame(-42.12, $value->getValue());
        $this->assertSame('-42.12%', (string) $value);

        $value = new PercentValue(42.123);
        $this->assertSame(42.123, $value->getValue());
        $this->assertSame('42.12%', (string) $value);

        $value = new PercentValue(-42.123);
        $this->assertSame(-42.123, $value->getValue());
        $this->assertSame('-42.12%', (string) $value);

        $value = new PercentValue(42.129);
        $this->assertSame(42.129, $value->getValue());
        $this->assertSame('42.13%', (string) $value);

        $value = new PercentValue(-42.129);
        $this->assertSame(-42.129, $value->getValue());
        $this->assertSame('-42.13%', (string) $value);
    }
}
