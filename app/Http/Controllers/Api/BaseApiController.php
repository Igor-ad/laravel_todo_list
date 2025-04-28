<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Controllers\ResponseTrait;

abstract class BaseApiController extends Controller
{
    use ResponseTrait;
}
