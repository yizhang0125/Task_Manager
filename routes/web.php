<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;

Route::get ('/', [TaskController::class, 'fetchAllTasks'])->name('index');
Route::get('/create', [TaskController::class, 'createTask'])->name('create');
Route::post('/addTask', [TaskController::class, 'addTask'])->name('addTask');