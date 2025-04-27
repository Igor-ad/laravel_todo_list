<?php

namespace App\Exceptions;

use App\Exceptions\Task\NotFoundException;
use App\Exceptions\Task\AuthException;
use App\Exceptions\Task\ServiceException;
use App\Exceptions\Task\ValidationException;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Database\QueryException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Validation\ValidationException as ValidatorException;
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

            return match (true) {
                $e instanceof ValidatorException && $request->is('api/*')
                => throw new ValidationException($e->validator),

                $e instanceof AuthenticationException && $request->is('api/*')
                => throw new AuthException($e->getMessage()),

                $e instanceof QueryException
                => throw new ServiceException($e->getMessage()),

                $e instanceof NotFoundHttpException
                => throw new NotFoundException(str_replace(
                    search: ['[App\\Models\\', ']'],
                    replace: [': ', ''],
                    subject: $e->getMessage(),
                )),

                default => false,
            };

        });
    }
}
