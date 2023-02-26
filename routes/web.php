<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\TaskController;
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

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');

// Task controller
Route::get('/add-task', [TaskController::class, 'addTask'])->name('task.add');
Route::post('/insert-task', [TaskController::class, 'insertTask'])->name('insert.task');
Route::get('/edit-task/{id}', [TaskController::class, 'editTask'])->name('edit.task');
Route::post('/update-task', [TaskController::class, 'updateTask'])->name('update.task');
Route::get('/delete-task/{id}', [TaskController::class, 'deleteTask'])->name('delete.task');
Route::get('/mark-as-completed-task/{id}', [TaskController::class, 'completedTask'])->name('completed.task');
Route::get('/test', [TaskController::class, 'test'])->name('test');