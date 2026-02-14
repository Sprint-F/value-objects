<?php

declare(strict_types=1);

namespace SprintF\ValueObjects\Type;

use DateTimeImmutable;
use DateTimeInterface;

/**
 * Немного улучшенный стандартный тип \DateTime.
 *
 * @method static DateTime createFromFormat(string $format, string $datetime, ?\DateTimeZone $timezone = null)
 * @method static DateTime createFromImmutable(DateTimeImmutable $object)
 * @method static DateTime createFromInterface(DateTimeInterface $object)
 */
class DateTime extends \DateTime implements \Stringable
{
    public const string RUSSIAN_DATE_TIME = 'd.m.Y H:i:s';

    public static function createFromTimestamp(float|int $timestamp): static
    {
        if (PHP_VERSION_ID >= 80400) {
            return parent::createFromTimestamp($timestamp);
        }

        return static::createFromFormat('U', (string) $timestamp);
    }

    public function __toString(): string
    {
        return $this->format('c');
    }
}
