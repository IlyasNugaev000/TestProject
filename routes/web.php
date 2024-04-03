<?php

use App\Http\Controllers\ProfileController;
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

Route::prefix('dashboard')->middleware(['auth', 'verified'])->name('dashboard.')->group(function () {
    Route::get('', \App\Http\Controllers\DashboardController::class)->middleware(['auth', 'verified'])->name('get');
    Route::get('/project/{id}', [\App\Http\Controllers\DashboardController::class, 'detail'])->name('project');
    Route::get('/project/{id}/edit', [\App\Http\Controllers\DashboardController::class, 'edit'])->name('project.edit');
});

Route::prefix('project')->middleware(['auth', 'verified'])->name('project.')->group(function () {
    Route::get('/create', [\App\Http\Controllers\ProjectController::class, 'create'])->name('create');
    Route::post('/store', [\App\Http\Controllers\ProjectController::class, 'store'])->name('store');
    Route::delete('/user', [\App\Http\Controllers\ProjectController::class, 'deleteUser'])->name('user.delete');
    Route::patch('/update', [\App\Http\Controllers\ProjectController::class, 'update'])->name('update');
    Route::post('/user', [\App\Http\Controllers\ProjectController::class, 'addUser'])->name('user.add');
    Route::delete('', [\App\Http\Controllers\ProjectController::class, 'delete'])->name('delete');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
