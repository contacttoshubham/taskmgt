<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\UserController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('task', [TaskController::class, 'index'])->name('task');
    Route::post('add-task', [TaskController::class, 'store'])->name('add-task');
    Route::get('task-list', [TaskController::class, 'show'])->name('task-list');
    Route::get('task-edit/{task}', [TaskController::class, 'edit'])->name('task-edit');
    Route::post('task-update/{task}', [TaskController::class, 'update'])->name('task-update');
    Route::get('delete-task/{task}', [TaskController::class, 'destroy'])->name('delete-task');

    Route::get('assign-task', [UserController::class, 'index'])->name('assign-task');
    Route::post('assign-task-update', [UserController::class, 'update'])->name('assign-task-update');
});


require __DIR__.'/auth.php';
