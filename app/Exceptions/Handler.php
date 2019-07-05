<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\Response;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = [
        'password',
        'password_confirmation',
    ];

    /**
     * Report or log an exception.
     *
     * @param  \Exception  $exception
     * @return void
     */
    public function report(Exception $exception)
    {
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Exception  $exception
     * @return \Illuminate\Http\Response
     */
    public function render($request, Exception $exception)
    {
        if ($exception instanceof ModelNotFoundException) {
            return response()->json(
                ['status' => Response::HTTP_NOT_FOUND, 'message' => 'resource not found'],
                Response::HTTP_NOT_FOUND
            );
        }

        if ($exception instanceof MethodNotAllowedHttpException) {
            return response()->json(
                ['status' => Response::HTTP_METHOD_NOT_ALLOWED, 'message' => 'method not allowed'],
                Response::HTTP_NOT_FOUND
            );
        }

        if ($exception instanceof UnauthorizedHttpException) {
            return response()->json(
                ['status' => Response::HTTP_UNAUTHORIZED, 'message' => 'unauthorized'],
                Response::HTTP_UNAUTHORIZED
            );
        }

        return parent::render($request, $exception);
    }
}
