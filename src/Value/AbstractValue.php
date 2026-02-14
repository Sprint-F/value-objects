<?php

declare(strict_types=1);

namespace SprintF\ValueObjects\Value;

/**
 * Абстрактный класс объекта-значения.
 */
abstract class AbstractValue implements \Stringable
{
    final public function __construct($value)
    {
        $this->setValue($value);
    }

    abstract public function getValue(): mixed;

    abstract protected function setValue(null $value): void;

    public function __toString(): string
    {
        return null === $this->getValue() ? '-' : (string) $this->value;
    }
}
