<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Services\AnswerService;
use App\Services\ResponseService;


trait ServiceMapper
{
    protected function answer(): AnswerService
    {
        return resolve('answerSrv');
    }

    protected function response(): ResponseService
    {
        return resolve('responseSrv');
    }

    protected function serviceLayerData(): array|bool|null|object
    {
        return $this->answer()->answerData->getData();
    }

    protected function serviceLayerMsg(): string
    {
        return $this->answer()->answerData->getMessage();
    }
}
