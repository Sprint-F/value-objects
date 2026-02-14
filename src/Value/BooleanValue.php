<?php

declare(strict_types=1);

namespace SprintF\ValueObjects\Value;

class BooleanValue extends AbstractValue
{
    protected ?bool $value;

    public function getValue(): ?bool
    {
        return $this->value;
    }

    protected function setValue(?bool $value): void
    {
        $this->value = $value;
    }

    public function __toString(): string
    {
        return null === $this->getValue() ? '?' : ($this->getValue() ? '+' : '-');
    }
}
