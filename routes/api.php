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
// Test
Route::middleware(['auth:api'])->group(callback: function () {
    Route::get('/tasks', [TaskIndexController::class, 'index']);
    Route::get('/task/show/{task}', [TaskController::class, 'show']);
    Route::get('/task/done/{task}', [TaskMarkedDoneController::class, 'done']);
    Route::get('/task/add', [TaskController::class, 'add']);
    Route::get('/task/update', [TaskController::class, 'update']);
    Route::get('/task/del/{task}', [TaskController::class, 'del']);
});

//Route::middleware(['auth:api'])->group(callback: function () {
//    Route::get('/tasks', [TaskIndexController::class, 'index']);
//    Route::get('/task/show/{task}', [TaskController::class, 'show']);
//    Route::get('/task/done/{task}', [TaskMarkedDoneController::class, 'done']);
//    Route::post('/task/add', [TaskController::class, 'add']);
//    Route::put('/task/update', [TaskController::class, 'update']);
//    Route::delete('/task/del/{task}', [TaskController::class, 'del']);
//});
