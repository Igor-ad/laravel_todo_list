<?php

namespace App\Http\Controllers;

use App\Services\AnswerService;
use App\Services\ResponseService;
use Exception;

trait ServiceMapper
{
    /**
     * @param $service
     * @param $method
     * @param $id
     * @return ResponseService
     */
    private function getService($service, $method, $id = null): ResponseService
    {
        return $service->$method($id);
    }

    /**
     * @param $service
     * @param $method
     * @param $id
     * @return AnswerService
     */
    protected function getAnswer($service, $method, $id = null): AnswerService
    {
        try {
            $response = $this->getService($service, $method, $id);

            $this->answerService->setAnswer($response);

        } catch (Exception $e) {
            $this->answerService->setExceptionAnswer($e);
        }
        return $this->answerService;
    }
}
