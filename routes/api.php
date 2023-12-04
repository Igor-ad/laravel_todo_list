<?php

use App\Http\Controllers\Api\ApiAuthController;
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
    Route::get('/tasks', [IndexController::class, 'index'])->name('api.index');
    Route::get('/tasks/show/{task}', [ShowController::class, 'show'])->name('api.show');
    Route::put('/tasks/complete/{task}', [CompleteController::class, 'complete'])->name('api.complete');
    Route::post('/tasks/create', [CreateController::class, 'create'])->name('api.create');
    Route::put('/tasks/update', [UpdateController::class, 'update'])->name('api.update');
    Route::delete('/tasks/delete/{task}', [DeleteController::class, 'delete'])->name('api.delete');
});

Route::get('/login', [ApiAuthController::class, 'login'])->name('api.login');

Route::post('/login', ['as' => 'login']);
