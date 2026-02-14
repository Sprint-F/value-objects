<?php

declare(strict_types=1);

namespace SprintF\Tests\Type;

use Codeception\Test\Unit;
use SprintF\Tests\Support\UnitTester;
use SprintF\ValueObjects\Type\Date;

/**
 * @internal
 *
 * @coversNothing
 */
class DateTest extends Unit
{
    protected UnitTester $tester;

    protected function _before() {}

    // tests
    public function testCreateConstruct()
    {
        $date = new Date();
        $this->assertInstanceOf(Date::class, $date);
        $today = new \DateTime('now');
        $this->assertSame($today->format('Y').'-'.$today->format('m').'-'.$today->format('d').'T00:00:00.000+00:00', $date->format(Date::RFC3339_EXTENDED));

        $date = new Date('now');
        $this->assertInstanceOf(Date::class, $date);
        $today = new \DateTime('now');
        $this->assertSame($today->format('Y').'-'.$today->format('m').'-'.$today->format('d').'T00:00:00.000+00:00', $date->format(Date::RFC3339_EXTENDED));

        $this->expectException(\DateMalformedStringException::class);
        $today = new \DateTime('wrong date');
    }

    public function testCreateFromFormat()
    {
        $date = Date::createFromFormat('Y-m-d', '2001-02-03');
        $this->assertInstanceOf(Date::class, $date);

        $this->assertSame('2001-02-03T00:00:00.000+00:00', $date->format(Date::RFC3339_EXTENDED));

        $date = Date::createFromFormat('Y-m-d', 'wrong date');
        $this->assertFalse($date);
    }

    public function testCreateFromImmutable()
    {
        $date = Date::createFromImmutable(new \DateTimeImmutable('2001-02-03'));
        $this->assertInstanceOf(Date::class, $date);

        $this->assertSame('2001-02-03T00:00:00.000+00:00', $date->format(Date::RFC3339_EXTENDED));
    }

    public function testCreateFromInterface()
    {
        $date = Date::createFromInterface(new \DateTime('2001-02-03'));
        $this->assertInstanceOf(Date::class, $date);

        $this->assertSame('2001-02-03T00:00:00.000+00:00', $date->format(Date::RFC3339_EXTENDED));
    }

    public function testCreateFromTimestamp()
    {
        $date = Date::createFromTimestamp(time());
        $this->assertInstanceOf(Date::class, $date);
        $today = new \DateTime('now');
        $this->assertSame($today->format('Y').'-'.$today->format('m').'-'.$today->format('d').'T00:00:00.000+00:00', $date->format(Date::RFC3339_EXTENDED));
    }

    public function testSetTime()
    {
        $this->expectException(\BadMethodCallException::class);
        $date = new Date();
        $date->setTime(12, 34);
    }

    public function testSetMicrosecond()
    {
        $this->expectException(\BadMethodCallException::class);
        $date = new Date();
        $date->setMicrosecond(12);
    }

    public function testToString()
    {
        $date = new Date();
        $this->assertSame((new \DateTime('today'))->format('Y-m-d'), (string) $date);
    }
}
