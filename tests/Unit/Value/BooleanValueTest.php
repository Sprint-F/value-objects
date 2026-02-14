<?php

namespace SprintF\Tests\Value;

use Codeception\Test\Unit;
use SprintF\Tests\Support\UnitTester;
use SprintF\ValueObjects\Value\BooleanValue;

/**
 * @internal
 *
 * @coversNothing
 */
class BooleanValueTest extends Unit
{
    protected UnitTester $tester;

    public function testNull()
    {
        $value = new BooleanValue(null);
        $this->assertNull($value->getValue());
    }

    public function testFalse()
    {
        $value = new BooleanValue(false);
        $this->assertFalse($value->getValue());
    }

    public function testTrue()
    {
        $value = new BooleanValue(true);
        $this->assertTrue($value->getValue());
    }

    public function testNotBoolean()
    {
        $this->expectException(\TypeError::class);
        $value = new BooleanValue('foo');
    }

    public function testToString()
    {
        $value = new BooleanValue(null);
        $this->assertSame('?', (string) $value);

        $value = new BooleanValue(false);
        $this->assertSame('-', (string) $value);

        $value = new BooleanValue(true);
        $this->assertSame('+', (string) $value);
    }
}
