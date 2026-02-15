<?php

declare(strict_types=1);

namespace SprintF\ValueObjects\Math;

/**
 * Класс, объединяющий ряд методов для работы с натуральными дробями.
 */
class Fraction
{
    /**
     * Преобразование float к натуральной дроби с заданной точностью методом поиска наилучшего приближения.
     *
     * @param float  $number    число, которое следует преобразовать
     * @param int    $precision точность: максимальное число цифр в знаменателе
     * @param string $delimiter разделитель числителя и знаменателя
     *
     * @return string строковое представление дроби, с указанным знаком разделителя
     */
    public static function floatToFraction(float $number, int $precision = 2, string $delimiter = '/'): string
    {
        [$numerator, $denominator] = self::findBestFraction($number, pow(10, $precision));

        return "{$numerator}{$delimiter}{$denominator}";
    }

    /**
     * Преобразование float к натуральной дроби с заданной точностью методом поиска наилучшего приближения.
     *
     * @param float $number    число, которое следует преобразовать
     * @param int   $precision точность: максимальное число цифр в знаменателе
     *
     * @return array{numerator: int, denominator: int}
     */
    private static function findBestFraction(float $number, int $precision): array
    {
        $bestNumerator = 1;
        $bestDenominator = 1;
        $bestDifference = abs($number - $bestNumerator / $bestDenominator);

        for ($denominator = 1; $denominator <= $precision; ++$denominator) {
            $numerator = round($number * $denominator);
            $difference = abs($number - $numerator / $denominator);

            if ($difference < $bestDifference) {
                $bestNumerator = $numerator;
                $bestDenominator = $denominator;
                $bestDifference = $difference;
            }

            if (0 == $difference) {
                break;
            }
        }

        return [$bestNumerator, $bestDenominator];
    }
}
