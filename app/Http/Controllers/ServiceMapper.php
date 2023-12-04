<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Services\AnswerService;

trait ServiceMapper
{
    public function __construct(
        protected AnswerService $answerService,
    )
    {
    }
}
