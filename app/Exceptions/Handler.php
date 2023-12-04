<?php

namespace App\Exceptions;

use App\Exceptions\Task\Task404Exception;
use App\Exceptions\Task\TaskAuthException;
use App\Exceptions\Task\TaskServiceException;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Throwable;

class Handler extends ExceptionHandler
{
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

        $this->renderable(function (Throwable $e, $request) {
            if ($e instanceof TaskServiceException) {
                throw new TaskServiceException($e->getMessage());
            }

            if ($request->is('api/*') && $e instanceof AuthenticationException) {
                throw new TaskAuthException($e->getMessage());
            }

            if ($request->is('api/*') && ($e instanceof NotFoundHttpException)) {
                throw new Task404Exception($e->getMessage());
            }
        });
    }
}
