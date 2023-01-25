<?php

namespace App\Services;

class MathService
{
    /**
     * @param int $value
     * @return float|int Return The square root of number, or NAN for negative numbers
     */
    public function square(int $value): float|int
    {
        return sqrt($value);
    }

    /**
     * @param int $base
     * @param int $expo
     * @return float|int Return x raised to the power of y
     *
     */
    public function power(int $base, int $expo): float|int
    {
        return pow($base,$expo);
    }
}