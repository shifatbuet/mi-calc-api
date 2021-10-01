<?php

namespace App\Http\Factories;

use App\Http\Services\CalculatorService;

class CalculatorFactory
{
    /**
     * Static function to build calc objects.
     *
     * @param string $type
     *
     * @return CalculatorService|void
     */
    public static function build($type = '')
    {
        $className = 'App\\Http\\Operations\\' . ucfirst($type);
        if (!class_exists($className)) {
            return;
        }

        return new $className();
    }
}
