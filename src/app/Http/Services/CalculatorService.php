<?php

namespace App\Http\Services;

/**
 * Interface for calculator operators.
 */
interface CalculatorService
{
    /**
     * Function to do the calculation.
     *
     * @param float $input1
     * @param float $input2
     *
     * @return float|int
     */
    public function calculate($input1, $input2);
}
