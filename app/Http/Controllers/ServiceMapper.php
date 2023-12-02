<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Services\AnswerService;
use App\Services\ResponseService;
use Exception;

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
                $response = $this->get($service, $method, $id);

                $this->answerService->setAnswer($response);

        } catch (Exception $e) {
            $this->answerService->setExceptionAnswer($e);
        }
        return $this->answerService;
    }
}
