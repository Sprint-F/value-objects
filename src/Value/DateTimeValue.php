<?php

declare(strict_types=1);

namespace SprintF\ValueObjects\Value;

use SprintF\Bundle\Datetime\Value\DateTime;

/**
 * @todo: Неверно, что мы тащим сюда класс из SprintF\Bundle\Datetime, наоборот: это бандл должен пользоваться классами из этой библиотеки!
 */
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
