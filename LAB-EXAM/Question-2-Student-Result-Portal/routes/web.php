<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ResultController;
use App\Http\Controllers\StudentController;
use Illuminate\Support\Facades\Route;

Route::get('/', fn () => redirect()->route('students.index'));
Route::get('/home', fn () => redirect()->route('students.index'))->name('home');
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.store');
});
Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::resource('students', StudentController::class);
    Route::post('/students/{student}/results', [ResultController::class, 'store'])->name('students.results.store');
    Route::delete('/students/{student}/results/{result}', [ResultController::class, 'destroy'])->name('students.results.destroy');
});
