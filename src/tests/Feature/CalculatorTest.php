<?php

namespace Tests\Feature;

use Tests\TestCase;

class CalculatorTest extends TestCase
{
    // Error message for validation error
    public const INVALID_MESSAGE = 'The given data was invalid.';
    public const DIVIDE_BY_ZERO  = 'Division by zero';

    /**
     * @dataProvider provideDataForSuccessCase
     *
     * @param array $dataArray
     * @param int   $status
     *
     * @return void
     */
    public function testsSuccessCalculatorOperations($dataArray, $status)
    {
        $response     = $this->postCall($dataArray);
        $actualData   = $response->getData()->data;
        $expectedData = $dataArray['expectedResult'];
        $this->assertEquals($expectedData, $actualData);
        $this->assertSame($status, $response->getStatusCode());
    }

    /**
     * @dataProvider provideDataForValidationError
     *
     * @param array $dataArray
     * @param int   $status
     *
     * @return void
     */
    public function testsValidationErrorOnCalculatorOperations($dataArray, $status)
    {
        $response      = $this->postCall($dataArray);
        $actualMessage = $response->getData()->message;
        $this->assertEquals(self::INVALID_MESSAGE, $actualMessage);
        $this->assertSame($status, $response->getStatusCode());
    }

    /**
     * @dataProvider provideDataForFailureCase
     *
     * @param array $dataArray
     * @param int   $status
     *
     * @return void
     */
    public function testsFailureCalculatorOperations($dataArray, $status)
    {
        $response      = $this->postCall($dataArray);
        $actualMessage = $response->getData()->message;
        $this->assertEquals(self::DIVIDE_BY_ZERO, $actualMessage);
        $this->assertSame($status, $response->getStatusCode());
    }
}
