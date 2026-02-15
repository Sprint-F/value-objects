<?php

declare(strict_types=1);

namespace SprintF\ValueObjects\Value;

/**
 * @todo: $scale! Чтобы понимать, это проценты или надо приводить к процентам
 *
 * @todo: $precision!
 */
class PercentValue extends AbstractValue
{
    protected float|int|null $value;

    public function getValue(): float|int|null
    {
        return $this->value;
    }

    protected function setValue(float|int|null $value): void
    {
        $this->value = $value;
    }

    public function __toString(): string
    {
        return null === $this->getValue() ? '-' : round($this->getValue(), 2).'%';
    }
}
