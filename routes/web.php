<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ExampleController;
use App\Http\Controllers\MessageController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

// message.index out of the middleware

Route::middleware(['auth', 'verified'])->group(function () {
    
    Route::get('/', [MessageController::class, 'index'])->name('message.index');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::group(['prefix' => 'edit'], function () {
        Route::post('{message_uuid}/update', [MessageController::class, 'update'])->name('message.update');
        Route::get('/{message_uuid}', [MessageController::class, 'edit'])->name('message.edit');
        Route::delete('/destroy', [MessageController::class, 'destroy'])->name('message.destroy');
    });
});
    
    Route::group(['prefix' => 'code'], function () {
        Route::get('/{any?}', [MessageController::class, 'create'])->name('message.Create');
        Route::post('/', [MessageController::class, 'store'])->name('message.store');
    });

require __DIR__ . '/auth.php';
