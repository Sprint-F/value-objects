<?php

namespace SprintF\Tests\Value;

use Codeception\Test\Unit;
use SprintF\Tests\Support\UnitTester;
use SprintF\ValueObjects\Value\TimeHoursValue;

/**
 * @internal
 *
 * @coversNothing
 */
class TimeHoursValueTest extends Unit
{
    protected UnitTester $tester;

    public function testNull()
    {
        $value = new TimeHoursValue(null);
        $this->assertNull($value->getValue());
        $this->assertSame('-', (string) $value);
    }

    public function testInvalid()
    {
        $this->expectException(\TypeError::class);
        $value = new TimeHoursValue('foo');
    }

    public function testHours()
    {
        $value = new TimeHoursValue(0);
        $this->assertSame(0, $value->getValue());
        $this->assertSame('00<sup>m</sup>', (string) $value);

        $value = new TimeHoursValue(1);
        $this->assertSame(1, $value->getValue());
        $this->assertSame('1<sup>h</sup> 00<sup>m</sup>', (string) $value);

        $value = new TimeHoursValue(13);
        $this->assertSame(13, $value->getValue());
        $this->assertSame('13<sup>h</sup> 00<sup>m</sup>', (string) $value);
    }

    public function testHoursAndMinutes()
    {
        $value = new TimeHoursValue(0.1);
        $this->assertSame(0.1, $value->getValue());
        $this->assertSame('06<sup>m</sup>', (string) $value);

        $value = new TimeHoursValue(0.5);
        $this->assertSame(0.5, $value->getValue());
        $this->assertSame('30<sup>m</sup>', (string) $value);

        $value = new TimeHoursValue(17.766666667);
        $this->assertSame(17.766666667, $value->getValue());
        $this->assertSame('17<sup>h</sup> 46<sup>m</sup>', (string) $value);
    }
}
