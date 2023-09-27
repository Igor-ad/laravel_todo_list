<?php

use App\Enums\TaskPathEnum as Path;
use App\Enums\PathEnum;
use App\Http\Controllers\Api\TaskShowController;
use App\Http\Controllers\Api\TaskDeleteController;
use App\Http\Controllers\Api\TaskIndexController;
use App\Http\Controllers\Api\TaskUpdateController;
use App\Http\Controllers\Api\TaskCreateController;
use App\Http\Controllers\Api\TaskCompleteController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware(['auth:api'])->group(callback: function () {
    Route::get(Path::index->value, [TaskIndexController::class, 'index']);
    Route::get(Path::show->value . '{task}', [TaskShowController::class, 'show']);
    Route::put(Path::complete->value . '{task}', [TaskCompleteController::class, 'complete']);
    Route::post(Path::create->value, [TaskCreateController::class, 'create']);
    Route::put(Path::update->value, [TaskUpdateController::class, 'update']);
    Route::delete(Path::delete->value . '{task}', [TaskDeleteController::class, 'delete']);
});

Route::get(PathEnum::login->value, function () {
    return response()->json(
        data: [
            'status' => 200,
            'message' => __('auth.api_login'),
            'help' => __('exception.help'),
        ],
        status: 200,
        options: JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT
    );
});

Route::post(PathEnum::login->value, ['as' => 'login']);
