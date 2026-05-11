<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\TaskController;

Auth::routes();

Route::middleware('auth')->group(function () {

    Route::get('/',            [TaskController::class, 'index'])->name('tasks.index');
    Route::get('/tasks',       [TaskController::class, 'index'])->name('tasks.list');

    // ✅ ADDED — must be before /tasks/{id} to avoid conflict
    Route::get('/tasks/trash', [TaskController::class, 'trash'])->name('tasks.trash');

    Route::post  ('/tasks',              [TaskController::class, 'store'])        ->name('tasks.store');
    Route::put   ('/tasks/{id}',         [TaskController::class, 'update'])       ->name('tasks.update');
    Route::delete('/tasks/{id}',         [TaskController::class, 'destroy'])      ->name('tasks.destroy');

    Route::patch ('/tasks/{id}/status',  [TaskController::class, 'updateStatus']) ->name('tasks.updateStatus');

    Route::post  ('/tasks/{id}/restore', [TaskController::class, 'restore'])      ->name('tasks.restore');
    Route::delete('/tasks/{id}/force',   [TaskController::class, 'forceDelete'])  ->name('tasks.forceDelete');

    Route::post('/logout', function () {
        Auth::logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();
        return redirect('/login');
        })->name('logout');

});

Auth::routes();
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');