<?php

declare(strict_types=1);

namespace SprintF\ValueObjects\Value;

/**
 * @todo Более точное название класса
 * @todo $precision = {d, h, m, s}
 */
class TimeHoursValue extends AbstractValue
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
        if (null === $this->getValue()) {
            return '-';
        }

        $h = floor($this->getValue());
        $m = round(($this->getValue() - $h) * 60);
        $s = round(($this->getValue() - $h - $m / 60) * 3600);

        if ($h > 0) {
            return $h.'<sup>h</sup> '.sprintf('%02d', $m).'<sup>m</sup>';
        }

        return sprintf('%02d', $m).'<sup>m</sup>';
    }
}
