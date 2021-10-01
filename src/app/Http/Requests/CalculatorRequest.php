<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CalculatorRequest extends FormRequest
{
    /**
     * Definition of constants for operations.
     */
    public const ADD      = 'add';
    public const SUBTRACT = 'subtract';
    public const MULTIPLY = 'multiply';
    public const DIVIDE   = 'divide';

    /**
     * Validation errors constant.
     */
    public const REQUIRED_INPUT_1   = 'input_1 is required!';
    public const REQUIRED_INPUT_2   = 'input_2 is required!';
    public const REQUIRED_OPERATION = 'operation is required!';
    public const OPERATION_VALUE_IN = 'operation must be ' . self::ADD . ', ' . self::SUBTRACT . ', ' . self::MULTIPLY
    . ' or ' . self::DIVIDE;

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'input_1'   => ['required', 'numeric'],
            'input_2'   => ['required', 'numeric'],
            'operation' => [
                'required',
                'max:10',
                Rule::in($this->getOperations()),
            ],
        ];
    }

    /**
     * Custom message for validation.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'input_1.required'   => self::REQUIRED_INPUT_1,
            'input_2.required'   => self::REQUIRED_INPUT_2,
            'operation.required' => self::REQUIRED_OPERATION,
            'operation.in'       => self::OPERATION_VALUE_IN,
        ];
    }

    /**
     * Return array of available operations.
     *
     * @return array
     */
    public function getOperations()
    {
        return [
            self::ADD,
            self::SUBTRACT,
            self::MULTIPLY,
            self::DIVIDE,
        ];
    }
}
