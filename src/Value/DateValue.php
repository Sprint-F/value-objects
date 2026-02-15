<?php

declare(strict_types=1);

namespace SprintF\ValueObjects\Value;

use SprintF\ValueObjects\Type\Date;

class DateValue extends AbstractValue
{
    protected ?Date $value;

    public function getValue(): ?Date
    {
        return $this->value;
    }

    protected function setValue(?Date $value): void
    {
        $this->value = $value;
    }

    public function __toString(): string
    {
        return null === $this->getValue() ? '-' : $this->getValue()->format(Date::RUSSIAN_DATE);
    }
}
