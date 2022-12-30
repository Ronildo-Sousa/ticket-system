<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\LabelController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('welcome');
});

Route::prefix('dashboard')->group(function () {
    Route::get('/', fn () => view('dashboard'))->name('dashboard');
    Route::resource('categories', CategoryController::class);
    Route::resource('labels', LabelController::class);

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
})->middleware(['auth']);

require __DIR__ . '/auth.php';
