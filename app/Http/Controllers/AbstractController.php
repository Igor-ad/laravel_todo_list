<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Services\AnswerService;

class AbstractController extends Controller
{
    use ResponseTrait;

    public function __construct(
        protected AnswerService $answer,
    ) {
    }
}
