<?php

declare(strict_types=1);

namespace SprintF\ValueObjects\Type;

/**
 * Тип "Дата".
 * Немного улучшенный стандартный \DateTime, в котором время внутри всегда 00:00:00.
 */
class Date extends \DateTime implements \Stringable
{
    public const string ISO8601_DATE_ONLY = 'Y-m-d';

    public const string RUSSIAN_DATE = 'd.m.Y';

    public function __construct(string $date = 'today', ?\DateTimeZone $timezone = null)
    {
        parent::__construct($date, $timezone);
        $this->nullTime();
    }

    #[\ReturnTypeWillChange]
    public static function createFromFormat($format, $datetime, $timezone = null): false|self
    {
        $date = parent::createFromFormat($format, $datetime, $timezone);
        if (false === $date) {
            return false;
        }
        $date->nullTime();

        return $date;
    }

    #[\ReturnTypeWillChange]
    public static function createFromImmutable(\DateTimeImmutable $object): self
    {
        return parent::createFromImmutable($object)->nullTime();
    }

    #[\ReturnTypeWillChange]
    public static function createFromInterface(\DateTimeInterface $object): self
    {
        return self::createFromFormat('!'.self::ISO8601_DATE_ONLY, $object->format(self::ISO8601_DATE_ONLY));
    }

    public static function createFromTimestamp(float|int $timestamp): static
    {
        if (PHP_VERSION_ID >= 80400) {
            return parent::createFromTimestamp($timestamp)->nullTime();
        }

        return self::createFromFormat('U', $timestamp);
    }

    #[\ReturnTypeWillChange]
    public function setTime($hour, $minute, $second = 0, $microsecond = 0): self
    {
        throw new \BadMethodCallException();
    }

    private function nullTime(): self
    {
        return parent::setTime(0, 0, 0, 0);
    }

    #[\ReturnTypeWillChange]
    public function setMicrosecond(int $microsecond = 0): static
    {
        throw new \BadMethodCallException();
    }

    public function __toString(): string
    {
        return $this->format(self::ISO8601_DATE_ONLY);
    }
}
