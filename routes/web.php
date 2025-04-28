<?php

use App\Http\Controllers\Web\Task\AddController;
use App\Http\Controllers\Web\Task\CompleteController;
use App\Http\Controllers\Web\Task\CreateController;
use App\Http\Controllers\Web\Task\DeleteController;
use App\Http\Controllers\Web\Task\EditController;
use App\Http\Controllers\Web\Task\IndexController;
use App\Http\Controllers\Web\Task\ShowController;
use App\Http\Controllers\Web\Task\UpdateController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified',])->group(function () {
    Route::get('/dashboard', function () {
        return Inertia::render('Dashboard');
    })->name('dashboard');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/tasks', [IndexController::class, 'index'])->name('web.index');
    Route::get('/tasks/show/{task}', [ShowController::class, 'show'])->name('web.show');
    Route::get('/tasks/complete/{task}', [CompleteController::class, 'complete'])->name('web.complete');
    Route::get('/tasks/edit/{task}', [EditController::class, 'edit'])->name('web.edit');
    Route::get('/tasks/add', [AddController::class, 'add'])->name('web.add');
    Route::post('/tasks/create', [CreateController::class, 'create'])->name('web.create');
    Route::post('/tasks/update/{task}', [UpdateController::class, 'update'])->name('web.update');
    Route::get('/tasks/delete/{task}', [DeleteController::class, 'delete'])->name('web.delete');
    Route::post('/logout', function () {
        session()->flush();
        return redirect('/login');
    })->name('web.logout');
});
