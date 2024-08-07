<?php

namespace App\Exceptions;

use Error;
use Exception;
use Throwable;


use ErrorException;

use BadMethodCallException;
use App\Traits\ApiResponser;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\QueryException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\Eloquent\RelationNotFoundException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;

class Handler extends ExceptionHandler
{
    use ApiResponser;

    /**
     * The list of the inputs that are never flashed to the session on validation exceptions.
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
     */
    public function register(): void
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }
    public function render($request, Throwable $e)
    {
        // return parent::render($request, $e);
        // return $this->errorResponse($e->getMessage(), 500);

        if ($e instanceof ErrorException) {

            return $this->errorResponse($e->getMessage(), 500);
        }


        // if ($e instanceof ModelNotFoundException) {

        //     return $this->errorResponse($e->getMessage(), 404);
        // }

        // if ($e instanceof NotFoundHttpException) {
        //     DB::rollBack();
        //     return $this->errorResponse($e->getMessage(), 404);
        // }

        // if ($e instanceof MethodNotAllowedHttpException) {
        //     DB::rollBack();
        //     return $this->errorResponse($e->getMessage(), 500);
        // }

        // if ($e instanceof Exception) {
        //     DB::rollBack();
        //     return $this->errorResponse($e->getMessage(), 500);
        // }

        // if ($e instanceof BadMethodCallException) {
        //     DB::rollBack();
        //     return $this->errorResponse($e->getMessage(), 500);
        // }

        // if ($e instanceof Error) {
        //     DB::rollBack();
        //     return $this->errorResponse($e->getMessage(), 500);
        // }

        // if ($e instanceof QueryException) {
        //     DB::rollBack();
        //     return $this->errorResponse($e->getMessage(), 500);
        // }

        // if ($e instanceof RelationNotFoundException) {
        //     DB::rollBack();
        //     return $this->errorResponse($e->getMessage(), 500);
        // }



        if (config('app.debug')) {
         
            return parent::render($request, $e);
        }

        
        return $this->errorResponse($e->getMessage(), 500);
    }
}
