<?php

use App\Enums\PathEnum;
use App\Enums\TaskPathEnum as Path;
use App\Http\Controllers\Web\Task\AddController;
use App\Http\Controllers\Web\Task\CompleteController;
use App\Http\Controllers\Web\Task\CreateController;
use App\Http\Controllers\Web\Task\DeleteController;
use App\Http\Controllers\Web\Task\EditController;
use App\Http\Controllers\Web\Task\IndexController;
use App\Http\Controllers\Web\Task\ShowController;
use App\Http\Controllers\Web\Task\UpdateController;
use Illuminate\Support\Facades\Route;

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
    Route::get(Path::index->value, [IndexController::class, 'index'])->name('web.index');
    Route::get(Path::show->value . '{task}', [ShowController::class, 'show'])->name('web.show');
    Route::get(Path::complete->value . '{task}', [CompleteController::class, 'complete'])->name('web.complete');
    Route::get(Path::edit->value . '{task}', [EditController::class, 'edit'])->name('web.edit');
    Route::get(Path::add->value, [AddController::class, 'add'])->name('web.add');
    Route::post(Path::create->value, [CreateController::class, 'create'])->name('web.create');
    Route::post(Path::update->value . '{task}', [UpdateController::class, 'update'])->name('web.update');
    Route::get(Path::delete->value . '{task}', [DeleteController::class, 'delete'])->name('web.delete');
//});

Route::get(PathEnum::login->value, function () {
    return redirect(Path::API->value . PathEnum::login->value);
});

Route::post(PathEnum::login->value, ['as' => 'login']);
