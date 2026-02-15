<?php

namespace SprintF\Tests\Value;

use Codeception\Test\Unit;
use SprintF\Tests\Support\UnitTester;
use SprintF\ValueObjects\Type\Date;
use SprintF\ValueObjects\Value\DateValue;

/**
 * @internal
 *
 * @coversNothing
 */
class DateValueTest extends Unit
{
    protected UnitTester $tester;

    public function testNull()
    {
        $value = new DateValue(null);
        $this->assertNull($value->getValue());
    }

    public function testValid()
    {
        $today = new Date('today');
        $value = new DateValue($today);
        $this->assertSame($today, $value->getValue());
    }

    public function testInvalid()
    {
        $this->expectException(\TypeError::class);
        $value = new DateValue('foo');
    }

    public function testToString()
    {
        $value = new DateValue(null);
        $this->assertSame('-', (string) $value);

        $today = new Date('today');
        $value = new DateValue($today);
        $this->assertSame($today->format('d.m.Y'), (string) $value);
    }
}
