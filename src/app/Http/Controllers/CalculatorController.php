<?php

namespace App\Http\Controllers;

use App\Http\Factories\CalculatorFactory;
use App\Http\Requests\CalculatorRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;

class CalculatorController extends BaseController
{
    /**
     * Function for calculator.
     *
     * @param CalculatorRequest $request
     *
     * @return JsonResponse
     */
    public function calculate(CalculatorRequest $request)
    {
        $val1     = $request->input('input_1');
        $val2     = $request->input('input_2');
        $operator = $request->input('operation');

        Log::info(
            'Calculating the inputs based on operation .',
            [
                'input_1' => $val1,
                'input_2' => $val2,
                'operator' => $operator,
            ]
        );

        $calc   = CalculatorFactory::build($operator);
        $result = $calc->calculate($val1, $val2);

        return $this->sendResponse($result);
    }
}
