<?php

namespace SprintF\Tests\Value;

use Codeception\Test\Unit;
use SprintF\Tests\Support\UnitTester;
use SprintF\ValueObjects\Value\DefaultValue;
use stdClass;

/**
 * @internal
 *
 * @coversNothing
 */
class DefaultValueTest extends Unit
{
    protected UnitTester $tester;

    public function testNull()
    {
        $value = new DefaultValue(null);
        $this->assertNull($value->getValue());
    }

    public function testGetValue()
    {
        foreach ([42, 3.14159, 'foo', false, true, [1, 2, 3], new stdClass()] as $v) {
            $value = new DefaultValue($v);
            $this->assertSame($v, $value->getValue());
        }
    }

    public function testToString()
    {
        $value = new DefaultValue(null);
        $this->assertSame('-', (string) $value);

        $value = new DefaultValue(42);
        $this->assertSame('42', (string) $value);

        $value = new DefaultValue(3.14159);
        $this->assertSame('3.14159', (string) $value);

        $value = new DefaultValue('foo');
        $this->assertSame('foo', (string) $value);

        $value = new DefaultValue(false);
        $this->assertSame('-', (string) $value);

        $value = new DefaultValue(true);
        $this->assertSame('+', (string) $value);

        $value = new DefaultValue(new class {
            public function __toString()
            {
                return 'bar';
            }
        });
        $this->assertSame('bar', (string) $value);
    }
}
