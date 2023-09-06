<?php

namespace App\Http\Controllers;

use App\Services\AnswerService;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    /**
     * @param AnswerService $answerService
     */
    public function __construct(
        protected AnswerService       $answerService,
    )
    {
    }
}
