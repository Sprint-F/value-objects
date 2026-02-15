<?php

namespace SprintF\Tests\Value;

use Codeception\Test\Unit;
use SprintF\Tests\Support\UnitTester;
use SprintF\ValueObjects\Value\MoneyValue;

/**
 * @internal
 *
 * @coversNothing
 */
class MoneyValueTest extends Unit
{
    protected UnitTester $tester;

    public function testNull()
    {
        $value = new MoneyValue(null);
        $this->assertNull($value->getValue());
        $this->assertSame('-', (string) $value);
    }

    public function testInteger()
    {
        $value = new MoneyValue(42);
        $this->assertSame(42, $value->getValue());
        $this->assertSame('42,00 ₽', (string) $value);

        $value = new MoneyValue(-42);
        $this->assertSame(-42, $value->getValue());
        $this->assertSame('-42,00 ₽', (string) $value);
    }

    public function testFloat()
    {
        $value = new MoneyValue(42.5);
        $this->assertSame(42.5, $value->getValue());
        $this->assertSame('42,50 ₽', (string) $value);

        $value = new MoneyValue(-42.5);
        $this->assertSame(-42.5, $value->getValue());
        $this->assertSame('-42,50 ₽', (string) $value);

        $value = new MoneyValue(42.51);
        $this->assertSame(42.51, $value->getValue());
        $this->assertSame('42,51 ₽', (string) $value);

        $value = new MoneyValue(-42.51);
        $this->assertSame(-42.51, $value->getValue());
        $this->assertSame('-42,51 ₽', (string) $value);

        $value = new MoneyValue(42.512);
        $this->assertSame(42.512, $value->getValue());
        $this->assertSame('42,51 ₽', (string) $value);

        $value = new MoneyValue(-42.512);
        $this->assertSame(-42.512, $value->getValue());
        $this->assertSame('-42,51 ₽', (string) $value);

        $value = new MoneyValue(42.519);
        $this->assertSame(42.519, $value->getValue());
        $this->assertSame('42,52 ₽', (string) $value);

        $value = new MoneyValue(-42.519);
        $this->assertSame(-42.519, $value->getValue());
        $this->assertSame('-42,52 ₽', (string) $value);
    }
}
