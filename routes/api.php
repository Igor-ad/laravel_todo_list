<?php

use App\Http\Controllers\Api\TaskController;
use App\Http\Controllers\Api\TaskIndexController;
use App\Http\Controllers\Api\TaskMarkedDoneController;
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
    Route::get('/tasks', [TaskIndexController::class, 'index']);
    Route::get('/tasks/show/{task}', [TaskController::class, 'show']);
    Route::put('/tasks/complete/{task}', [TaskMarkedDoneController::class, 'complete']);
    Route::post('/tasks/create', [TaskController::class, 'create']);
    Route::put('/tasks/update', [TaskController::class, 'update']);
    Route::delete('/tasks/delete/{task}', [TaskController::class, 'delete']);
});

Route::get('/login', function () {
    return response()->json(data: [
        'status' => 200,
        'message' => __('auth.api_login'),
        'help' => __('exception.help'),
    ], status: 200);
});

Route::post('login', [ 'as' => 'login']);
