<?php

namespace SprintF\ValueObjects\Enum;

/**
 * Интерфейс для перечислений, значение которых можно отобразить в человеко-читаемом виде.
 */
interface LabeledEnum
{
    public function label(): string;
}
