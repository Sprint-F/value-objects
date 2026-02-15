<?php

declare(strict_types=1);

namespace SprintF\ValueObjects\Value;

class DefaultValue extends AbstractValue
{
    protected mixed $value;

    public function getValue(): mixed
    {
        return $this->value;
    }

    protected function setValue(mixed $value): void
    {
        $this->value = $value;
    }
}
