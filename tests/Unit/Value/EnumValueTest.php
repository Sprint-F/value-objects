<?php

namespace SprintF\Tests\Value;

use Codeception\Test\Unit;
use SprintF\Tests\Support\UnitTester;
use SprintF\ValueObjects\Enum\LabeledEnum;
use SprintF\ValueObjects\Value\EnumValue;

enum TestNotBackedEnum
{
    case FOO;
}

enum TestEnumInt: int
{
    case FOO = 1;
}

enum TestEnumString: string
{
    case FOO = 'foo';
}

enum TestEnumLabel: string implements LabeledEnum
{
    case FOO = 'foo';

    public function label(): string
    {
        return 'label_foo';
    }
}

/**
 * @internal
 *
 * @coversNothing
 */
class EnumValueTest extends Unit
{
    protected UnitTester $tester;

    public function testNull()
    {
        $value = new EnumValue(null);
        $this->assertNull($value->getValue());
    }

    public function testNotBackedEnum()
    {
        $this->expectException(\TypeError::class);
        $value = new EnumValue(TestNotBackedEnum::FOO);
    }

    public function testIntBackedEnum()
    {
        $value = new EnumValue(TestEnumInt::FOO);
        $this->assertSame(TestEnumInt::FOO, $value->getValue());
        $this->assertSame('1', (string) $value);
    }

    public function testStringBackedEnum()
    {
        $value = new EnumValue(TestEnumString::FOO);
        $this->assertSame(TestEnumString::FOO, $value->getValue());
        $this->assertSame('foo', (string) $value);
    }

    public function testBackedEnumWithLabel()
    {
        $value = new EnumValue(TestEnumLabel::FOO);
        $this->assertSame(TestEnumLabel::FOO, $value->getValue());
        $this->assertSame('label_foo', (string) $value);
    }
}
