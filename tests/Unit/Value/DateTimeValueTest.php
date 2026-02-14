<?php

namespace SprintF\Tests\Value;

namespace SprintF\Tests\Type;
use Codeception\Test\Unit;
use SprintF\Tests\Support\UnitTester;
use SprintF\ValueObjects\Type\DateTime;
use SprintF\ValueObjects\Value\DateTimeValue;

/**
 * @internal
 *
 * @coversNothing
 */
class DateTimeValueTest extends Unit
{
    protected UnitTester $tester;

    public function testNull()
    {
        $value = new DateTimeValue(null);
        $this->assertNull($value->getValue());
    }

    public function testValid()
    {
        $now = new DateTime('now');
        $value = new DateTimeValue($now);
        $this->assertSame($now, $value->getValue());
    }

    public function testInvalid()
    {
        $this->expectException(\TypeError::class);
        $value = new DateTimeValue('foo');
    }

    public function testToString()
    {
        $value = new DateTimeValue(null);
        $this->assertSame('-', (string) $value);

        $now = new DateTime('now');
        $value = new DateTimeValue($now);
        $this->assertSame($now->format('d.m.Y H:i:s'), (string) $value);
    }
}
