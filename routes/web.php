<?php

use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Route;

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
    return view('welcome');
});


Route::get('/tasks', [TaskController::class, 'index'])->name('tasks');
Route::get('/tasks/{id}', [TaskController::class, 'show'])->where('id', '[0-9]+')->name('tasks.show');
Route::put('/tasks/{id}', [TaskController::class, 'update'])->where('id', '[0-9]+')->name('tasks.update');
