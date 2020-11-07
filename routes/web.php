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


Route::group(['prefix' => 'tasks', 'as' => 'tasks.'], function () {
    Route::get('/', [TaskController::class, 'index'])->name('index');
    Route::get('/{id}', [TaskController::class, 'show'])->where('id', '[0-9]+')->name('show');
    Route::get('/create', [TaskController::class, 'create'])->name('create');
    Route::post('/', [TaskController::class, 'store'])->name('store');
    Route::put('/{id}', [TaskController::class, 'update'])->where('id', '[0-9]+')->name('update');
    Route::delete('/{id}', [TaskController::class, 'destroy'])->where('id', '[0-9]+')->name('destroy');
});


