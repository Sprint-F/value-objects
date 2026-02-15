<?php

declare(strict_types=1);

namespace SprintF\ValueObjects\Value;

use SprintF\ValueObjects\Enum\LabeledEnum;

class EnumValue extends AbstractValue
{
    protected ?\BackedEnum $value;

    public function getValue(): ?\BackedEnum
    {
        return $this->value;
    }

    protected function setValue(?\BackedEnum $value): void
    {
        $this->value = $value;
    }

    public function __toString(): string
    {
        if (null === $this->value) {
            return '-';
        }

        if ($this->value instanceof LabeledEnum) {
            return $this->value->label();
        }

        return (string) $this->value->value;
    }
}
