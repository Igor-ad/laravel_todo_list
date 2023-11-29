<?php

use App\Enums\PathEnum;
use App\Enums\TaskPathEnum as Path;
use App\Http\Controllers\Api\Task\CompleteController;
use App\Http\Controllers\Api\Task\CreateController;
use App\Http\Controllers\Api\Task\DeleteController;
use App\Http\Controllers\Api\Task\IndexController;
use App\Http\Controllers\Api\Task\ShowController;
use App\Http\Controllers\Api\Task\UpdateController;
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
    Route::get(Path::index->value, [IndexController::class, 'index'])->name('api.tasks');
    Route::get(Path::show->value . '{task}', [ShowController::class, 'show'])->name('api.show');
    Route::put(Path::complete->value . '{task}', [CompleteController::class, 'complete'])->name('api.complete');
    Route::post(Path::create->value, [CreateController::class, 'create'])->name('api.create');
    Route::put(Path::update->value, [UpdateController::class, 'update'])->name('api.update');
    Route::delete(Path::delete->value . '{task}', [DeleteController::class, 'delete'])->name('api.delete');
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
