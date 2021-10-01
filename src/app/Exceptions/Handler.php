<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [

    ];

    /**
     * Report or log an exception.
     *
     * @param  Exception $exception
     * @return void
     *
     * @throws Exception
     */
    public function report(Exception $exception)
    {
        parent::report($exception);
    }

    /**
     * Render an exception into an Http response.
     *
     * @param Request   $request
     * @param Exception $exception
     *
     * @return JsonResponse|\Illuminate\Http\Response|Response
     */
    public function render($request, Exception $exception)
    {
        $message = null;
        if ($exception instanceof MethodNotAllowedHttpException) {
            $message = 'Method Not Allowed';

            return response()->json(['success' => false, 'message' => $message], 405);
        }

        if ($exception instanceof \ErrorException) {
            $message = $exception->getMessage();

            return response()->json(['success' => false, 'message' =>$message], 500);
        }
        Log::error(
            'Exception occurred in operation .',
            [
                'input_1' => $request->input('input_1'),
                'input_2'=>$request->input('input_2'),
                'operator'=>$request->input('operator'),
            ]
        );

        return parent::render($request, $exception);
    }
}
