<?php

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
    Route::get('/tasks', [IndexController::class, 'index'])->name('web.index');
    Route::get('/tasks/show/{task}', [ShowController::class, 'show'])->name('web.show');
    Route::get('/tasks/complete/{task}', [CompleteController::class, 'complete'])->name('web.complete');
    Route::get('/tasks/edit/{task}', [EditController::class, 'edit'])->name('web.edit');
    Route::get('/tasks/add', [AddController::class, 'add'])->name('web.add');
    Route::post('/tasks/create', [CreateController::class, 'create'])->name('web.create');
    Route::post('/tasks/update/{task}', [UpdateController::class, 'update'])->name('web.update');
    Route::get('/tasks/delete/{task}', [DeleteController::class, 'delete'])->name('web.delete');
//});

Route::get('/login', function () {
    return redirect('/api/login');
})->name('web.login');

Route::post('/login', ['as' => 'login'])->name('login');
