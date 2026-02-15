<?php

namespace SprintF\Tests\Value;

use Codeception\Test\Unit;
use SprintF\Tests\Support\UnitTester;
use SprintF\ValueObjects\Math\Fraction;

/**
 * @internal
 *
 * @coversNothing
 */
class FractionTest extends Unit
{
    protected UnitTester $tester;

    public function testInteger()
    {
        $this->assertSame('0/1', Fraction::floatToFraction(0));

        $this->assertSame('1/1', Fraction::floatToFraction(1));
        $this->assertSame('-1/1', Fraction::floatToFraction(-1));

        $this->assertSame('42/1', Fraction::floatToFraction(42));
        $this->assertSame('-42/1', Fraction::floatToFraction(-42));
    }

    public function testFiniteFloat()
    {
        $this->assertSame('1/2', Fraction::floatToFraction(0.5));
        $this->assertSame('-1/2', Fraction::floatToFraction(-0.5));

        $this->assertSame('1/4', Fraction::floatToFraction(0.25));
        $this->assertSame('-1/4', Fraction::floatToFraction(-0.25));

        $this->assertSame('3/7', Fraction::floatToFraction(0.428571429));
        $this->assertSame('-3/7', Fraction::floatToFraction(-0.428571429));
    }

    public function testInfiniteFloat()
    {
        $this->assertSame('22/7', Fraction::floatToFraction(M_PI, 1));
        $this->assertSame('-22/7', Fraction::floatToFraction(-M_PI, 1));

        $this->assertSame('311/99', Fraction::floatToFraction(M_PI, 2));
        $this->assertSame('-311/99', Fraction::floatToFraction(-M_PI, 2));

        $this->assertSame('355/113', Fraction::floatToFraction(M_PI, 3));
        $this->assertSame('-355/113', Fraction::floatToFraction(-M_PI, 3));
    }

    public function testDelimiter()
    {
        $this->assertSame('1/2', Fraction::floatToFraction(0.5));
        $this->assertSame('1÷2', Fraction::floatToFraction(0.5, delimiter: '÷'));
    }
}
