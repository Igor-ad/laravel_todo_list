<?php

use Illuminate\Support\Facades\Route;
use App\Enums\TaskPathEnum as Path;
use App\Enums\PathEnum;
use App\Http\Controllers\Web\TaskShowController;
use App\Http\Controllers\Web\TaskAddController;
use App\Http\Controllers\Web\TaskDeleteController;
use App\Http\Controllers\Web\TaskIndexController;
use App\Http\Controllers\Web\TaskUpdateController;
use App\Http\Controllers\Web\TaskEditController;
use App\Http\Controllers\Web\TaskCreateController;
use App\Http\Controllers\Web\TaskCompleteController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

//Route::middleware(['auth'])->group(callback: function () {
    Route::get(Path::index->value, [TaskIndexController::class, 'index']);
    Route::get(Path::show->value . '{task}', [TaskShowController::class, 'show']);
    Route::get(Path::complete->value . '{task}', [TaskCompleteController::class, 'complete']);
    Route::get(Path::edit->value . '{task}', [TaskEditController::class, 'edit']);
    Route::get(Path::add->value, [TaskAddController::class, 'add']);
    Route::post(Path::create->value, [TaskCreateController::class, 'create']);
    Route::post(Path::update->value . '{task}', [TaskUpdateController::class, 'update']);
    Route::get(Path::delete->value . '{task}', [TaskDeleteController::class, 'delete']);
//});

Route::get(PathEnum::login->value, function () {
    return redirect(Path::API->value . PathEnum::login->value);
});

Route::post(PathEnum::login->value, ['as' => 'login']);
