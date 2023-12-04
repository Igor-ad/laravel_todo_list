<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;

class ApiAuthController extends Controller
{
    public function login(): JsonResponse
    {
        return response()->json(
            data: [
                'status' => 200,
                'message' => __('auth.api_login'),
                'help' => __('exception.help'),
            ],
            status: 200,
            options: JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT
        );
    }
}
