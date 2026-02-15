<?php

declare(strict_types=1);

namespace SprintF\ValueObjects\Value;

class MoneyValue extends AbstractValue
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
        $formatter = \NumberFormatter::create('ru', \NumberFormatter::CURRENCY);

        return null === $this->getValue() ? '-' : $formatter->formatCurrency($this->getValue(), 'RUB');
    }
}
