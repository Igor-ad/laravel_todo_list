<?php

use Illuminate\Support\Facades\Route;
use App\Enums\TaskPathEnum as Path;

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

Route::get(Path::login->value, function () {
    return redirect(Path::API->value . Path::login->value);
});

Route::post(Path::login->value, [ 'as' => 'login']);
