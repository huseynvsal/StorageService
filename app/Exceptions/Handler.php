<?php

namespace App\Exceptions;

use Illuminate\Auth\AuthenticationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Throwable;

class Handler extends ExceptionHandler
{
    protected $levels = [
        //
    ];

    protected $dontReport = [
        ValidationException::class,
        UnreportableException::class
    ];

    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    public function register(): void
    {
        $this->renderable(function (NotFoundHttpException $e) {
            return response()->json([
                'code' => 404,
                'message' => 'Route not defined'
            ], 404);
        });
        $this->renderable(function (MethodNotAllowedHttpException $e) {
            return response()->json([
                'code' => 405,
                'message' => $e->getMessage()
            ], 405);
        });
        $this->renderable(function (ModelNotFoundException $e) {
            $model = explode('\\', $e->getModel());
            return response()->json([
                'code' => 404,
                'message' => array_pop($model).' with id: '.$e->getIds()[0].' does not exist'
            ], 404);
        });
        $this->renderable(function (AuthenticationException $e) {
            return response()->json([
                'code' => 401,
                'message' => 'Unauthenticated'
            ], 401);
        });

        $this->reportable(function (Throwable $e) {
            if (!env('APP_DEBUG') && app()->bound('sentry')) {
                app('sentry')->captureException($e);
            }
        });

        $this->renderable(function (Throwable $e) {
            if (!$this->isHttpException($e) && !env('APP_DEBUG')){
                return response()->json([
                    'code' => 500,
                    'message' => 'Technical error occurred in Storage Service'
                ], 500);
            }
        });
    }
}
