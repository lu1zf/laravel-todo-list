<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TodoController;
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

Route::get('/', [TodoController::class, 'index'])->name('index');
Route::get('/todo/create', [TodoController::class, 'create'])->name('create');
Route::post('/todo/create', [TodoController::class, 'store'])->name('store');
Route::get('/todo/edit/{id}', [TodoController::class, 'edit'])->name('edit');
Route::post('/todo/edit/{id}', [TodoController::class, 'update'])->name('update');
Route::get('/todo/{id}/done', [TodoController::class, 'markAsDone'])->name('done');
Route::get('/todo/{id}/delete', [TodoController::class, 'destroy'])->name('destroy');
