<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Auth\AuthenticationException;
use Spatie\Permission\Exceptions\UnauthorizedException;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Throwable;
use Tymon\JWTAuth\Exceptions\JWTException;
use App\Traits\ResponseTrait;
use BadMethodCallException;
use Facade\FlareClient\Http\Exceptions\NotFound;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\ItemNotFoundException;
use Symfony\Component\Translation\Exception\NotFoundResourceException;

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
     * Register the exception handling callbacks for the application.
     *
     * @return void
     */
    public function register()
    {
        //
    }
    public function render($request, Throwable $e)
    {
        $code =  $e->getCode();
        $msg  =  $e->getMessage();

        if ($e instanceof UnauthorizedException) {
            $code =  403;
        } else if ($e instanceof ValidationException) {
            $msg = $e->validator->errors()->first();
            $code = 400;
        } else if ($e instanceof NotFoundHttpException) {
            $code = 404;
            $msg = 'Route not found';
        }
        // else if ($e instanceof AuthenticationException) {
        //     $code = 403;
        //     $msg = 'UnAuthenticated';
        // }
         else if ($e instanceof ModelNotFoundException) {
            $code = 403;
            $msg = 'Not Found';
        }

        if (!$code || $code > 599 ||  $code <= 0 || gettype($code) !== "integer") {
            $code = 500;
        }

        return response()->json([
            'status' => 'Error',
            'message' => $msg,
            'data' => []
        ], $code);

    }
}

