<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    public const POST = 'POST';
    public const URI  = 'api/calculate';

    public function provideDataForSuccessCase()
    {
        return [
            [
                ['input_1' => 1, 'input_2' => 2, 'operation'=>'add', 'expectedResult' =>3], 200,
            ],
            [
                ['input_1' => 1, 'input_2' => 1, 'operation'=>'add', 'expectedResult' =>2], 200,
            ],
            [
                ['input_1' => 10, 'input_2' => 1, 'operation'=>'subtract', 'expectedResult' =>9], 200,
            ],
            [
                ['input_1' => 1, 'input_2' => 1, 'operation'=>'subtract', 'expectedResult' =>0], 200,
            ],
            [
                ['input_1' => 10, 'input_2' => 1, 'operation'=>'multiply', 'expectedResult' =>10], 200,
            ],
            [
                ['input_1' => 1, 'input_2' => 1, 'operation'=>'multiply', 'expectedResult' =>1], 200,
            ],
            [
                ['input_1' => 10, 'input_2' => 1, 'operation'=>'divide', 'expectedResult' =>10], 200,
            ],
            [
                ['input_1' => 1, 'input_2' => 1, 'operation'=>'divide', 'expectedResult' =>1], 200,
            ],
        ];
    }

    public function provideDataForValidationError()
    {
        return [
            [
                ['input_1' => 'wrong_data', 'input_2' => 2, 'operation'=>'add'], 422,
            ],
            [
                ['input_1' => 1, 'input_2' => 'wrong_data', 'operation'=>'add'], 422,
            ],
            [
                ['input_1' => 10, 'input_2' => 1, 'operation'=>'wrong_txt'], 422,
            ],
            [
                ['input_1' => 1, 'input_2' => 1, 'operation'=>'its_more_than_10_characters'], 422,
            ],
        ];
    }

    public function provideDataForFailureCase()
    {
        return [
            [
                ['input_1' => 1, 'input_2' => 0, 'operation'=>'divide'], 500,
            ],
        ];
    }

    public function postCall($dataArray)
    {
        return $this->call(self::POST, self::URI, $dataArray);
    }
}
