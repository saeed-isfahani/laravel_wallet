<?php

namespace App\Exceptions;

use App\Traits\ApiResponse;
use BadMethodCallException;
use ErrorException;
use Exception;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\Response;
use Illuminate\Validation\ValidationException;
use Illuminate\Validation\Validator as ValidationValidator;
use Symfony\Component\HttpFoundation\Exception\BadRequestException;
use Symfony\Component\HttpFoundation\Response as HttpFoundationResponse;
use Throwable;

class Handler extends ExceptionHandler
{
    //     use ApiResponse;
    //     /**
    //      * The list of the inputs that are never flashed to the session on validation exceptions.
    //      *
    //      * @var array<int, string>
    //      */
    //     protected $dontFlash = [
    //         'current_password',
    //         'password',
    //         'password_confirmation',
    //     ];

    //     /**
    //      * Register the exception handling callbacks for the application.
    //      */
    //     public function register(): void
    //     {
    //         $this->reportable(function (Throwable $e) {
    //             //
    //         });
    //     }

    //     public function render($request, Throwable $exception)
    //     {
    //         if ($request->wantsJson()) {   //add Accept: application/json in request
    //             $retval = $this->handleApiException($request, $exception);
    //         } else {
    //             $retval = parent::render($request, $exception);
    //         }

    //         return $request;
    //     }

    //     private function handleApiException($request, Exception $exception)
    //     {
    //         // dd('testooo');
    //         $exception = $this->prepareException($exception);

    //         if ($exception instanceof HttpResponseException) {
    //             // dd('http');
    //             $exception = $exception->getResponse();
    //         }

    //         if ($exception instanceof BadRequestException) {
    //             // dd('bad');
    //             $exception = $exception;
    //         }

    //         if ($exception instanceof AuthenticationException) {
    //             // dd('auth');
    //             $exception = $this->unauthenticated($request, $exception);
    //         }

    //         if ($exception instanceof ValidationException) {
    //             // dd('validation');
    //             $exception = $this->convertValidationExceptionToResponse($exception, $request);
    //         }

    //         // if ($exception instanceof BadMethodCallException) {
    //         //     dd($exception);
    //         //     $exception = $exception;
    //         // }

    //         // if ($exception instanceof ErrorException) {
    //         //     // dd($exception::class);
    //         //     $exception = $exception;
    //         // }
    // // dd($exception);
    //         return $this->customApiResponse($exception);
    //     }

    //     private function customApiResponse($exception)
    //     {
    //         if (method_exists($exception, 'getStatusCode')) {
    //             $statusCode = $exception->getStatusCode();
    //         } elseif (method_exists($exception, 'getCode')) {
    //             $statusCode = $exception->getCode();
    //         } else {
    //             $statusCode = 500;
    //         }

    //         $response = [];
    //         switch ($statusCode) {
    //             case 400:
    //                 $response['error'] = 'Bad Rerquest';
    //                 break;
    //             case 401:
    //                 $response['error'] = 'Unauthorized';
    //                 break;
    //             case 403:
    //                 $response['error'] = 'Forbidden';
    //                 break;
    //             case 404:
    //                 $response['error'] = 'Not Found';
    //                 break;
    //             case 405:
    //                 $response['error'] = 'Method Not Allowed';
    //                 break;
    //             case 422:
    //                 $response['error'] = $exception->original['error'];
    //                 $response['errors'] = $exception->original['errors'];
    //                 break;
    //             default:
    //                 $response['error'] = ($statusCode == 500) ? 'Whoops, looks like something went wrong' : $exception->getMessage();
    //                 break;
    //         }
    //         if (config('app.debug')) {
    //             $response['trace'] = $exception->getTrace();
    //             $response['code'] = $exception->getCode();
    //         }

    //         $response['status'] = $statusCode;

    //         // dd($exception);
    //         return $this->errorResponse([$response['error']], $exception->getMessage(), $statusCode);
    //     }

    /**
     * A list of the exception types that are not reported.
     *
     * @var array<int, class-string<Throwable>>
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     *
     * @return void
     */
    public function register()
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }
}
