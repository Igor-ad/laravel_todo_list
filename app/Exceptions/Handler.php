<?php

namespace App\Exceptions;

use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpFoundation\Response;
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

            if ($e instanceof AuthenticationException) {
                $e = new AuthenticationException($e->getMessage(), []);
                return response()->json(
                    data: [
                        'status' => Response::HTTP_UNAUTHORIZED,
                        'message' => sprintf(
                            "%s 'eMsg: %s'",
                            __('exception.unauthenticated'), $e->getMessage()
                        ),
                        'help' => __('exception.help'),
                        'code' => $e->getCode(),
                    ],
                    status: Response::HTTP_UNAUTHORIZED,
                    options: JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT,
                );
            }

            if ($request->is('api/*') && !($e->getMessage() === 'Unauthenticated.')) {
                return response()->json(
                    data: [
                        'status' => Response::HTTP_NOT_FOUND,
                        'message' => __('exception.404', ['message' => $e->getMessage()]),
                        'help' => __('exception.help'),
                        'code' => $e->getCode(),
                    ],
                    status: Response::HTTP_NOT_FOUND,
                    options: JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT,
                );
            }
        });
    }
}
