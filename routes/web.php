<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ExampleController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Example
    Route::group(['prefix' => 'example'], function () {
        Route::get('/',                             [ExampleController::class, 'index'])->name('example.index');
        Route::get('/create',                       [ExampleController::class, 'create'])->name('example.create'); 
        Route::post('/',                            [ExampleController::class, 'store'])->name('example.store'); 
        Route::post('{example_id}/update',          [ExampleController::class, 'update'])->name('example.update'); 
        Route::get('/{example_id}',                 [ExampleController::class, 'edit'])->name('example.edit'); 
        Route::delete('/destroy',                   [ExampleController::class, 'destroy'])->name('example.destroy'); 
    });

});

require __DIR__.'/auth.php';
