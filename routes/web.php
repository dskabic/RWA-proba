<?php

use App\Http\Controllers\AdController;
use App\Http\Controllers\ProfileController;
use App\Models\Ad;
use Illuminate\Support\Facades\Route;


Route::get('/', [AdController::class, 'short_view']);
Route::view('/contact', 'contact');
//index
Route::get('/ads', [AdController::class, 'index']);

//store
Route::post('/ads', [AdController::class, 'store'])->middleware('auth');

//create
Route::get('/ads/create', [AdController::class, 'create'])->middleware('auth');
//show
Route::get('/ads/{ad}', [AdController::class, 'show']);

Route::get('/ads/{ad}/edit', [AdController::class, 'edit'])->middleware('auth');
Route::patch('/ads/{ad}', [AdController::class, 'update'])->middleware('auth');
Route::delete('/ads/{ad}', [AdController::class, 'destroy'])->middleware('auth');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/profile/index/{user}', [ProfileController::class, 'index'])->name('users.ads.index');

});

require __DIR__.'/auth.php';

