<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Services\AnswerService;
use App\Services\ResponseService;
use Exception;
use Symfony\Component\Routing\Exception\MethodNotAllowedException;

trait ServiceMapper
{
    private function get(object $service, string $method, int $id = null): ResponseService
    {
        return $service->$method($id);
    }

    private function has(object $service, string $method): bool
    {
        return method_exists($service, $method);
    }

    protected function getAnswer($service, $method, $id = null): AnswerService
    {
        try {
            if ($this->has($service, $method)) {
                $response = $this->get($service, $method, $id);

                $this->answerService->setAnswer($response);
            } else {
                $allowedMethods = get_class_methods($service);

                throw new MethodNotAllowedException(
                    $allowedMethods,
                    __('exception.not_allowed_method', [
                        'method' => $method,
                        'class' => class_basename($service)
                    ]) .
                    __('exception.allowed_methods', [
                        'methods' => implode(', ', $allowedMethods)
                    ]),
                );
            }

        } catch (Exception $e) {
            $this->answerService->setExceptionAnswer($e);
        }
        return $this->answerService;
    }
}
