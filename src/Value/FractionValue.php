<?php

declare(strict_types=1);

namespace SprintF\ValueObjects\Value;

use SprintF\ValueObjects\Math\Fraction;

/**
 * @todo: $precision!
 */
class FractionValue extends AbstractValue
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
        return null === $this->getValue() ? '-' : Fraction::floatToFraction($this->getValue());
    }
}
