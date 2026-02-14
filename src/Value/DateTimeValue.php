<?php

declare(strict_types=1);

namespace SprintF\ValueObjects\Value;

use SprintF\ValueObjects\Type\DateTime;

class DateTimeValue extends AbstractValue
{
    protected ?DateTime $value;

    public function getValue(): ?DateTime
    {
        return $this->value;
    }

    protected function setValue(?DateTime $value): void
    {
        $this->value = $value;
    }

    public function __toString(): string
    {
        return null === $this->getValue() ? '-' : $this->getValue()->format(DateTime::RUSSIAN_DATE_TIME);
    }
}
