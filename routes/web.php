<?php

use App\Http\Controllers\CreditController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Feature1Controller;
use App\Http\Controllers\Feature2Controller;
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

Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');

Route::post('/buy_credits/webhook', [CreditController::class, 'webhook'])->name('credit.webhook');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/feature1', [Feature1Controller::class, 'index'])->name('feature1.index');
    Route::post('/feature1', [Feature1Controller::class, 'calculate'])->name('feature1.calculate');

    Route::get('/feature2', [Feature2Controller::class, 'index'])->name('feature2.index');
    Route::post('/feature2', [Feature2Controller::class, 'ollamaResponse'])->name('feature2.ollamaResponse');

    Route::get('/buy_credits', [CreditController::class, 'index'])->name('credit.index');
    Route::get('/buy_credits/success', [CreditController::class, 'success'])->name('credit.success');
    Route::get('/buy_credits/cancel', [CreditController::class, 'cancel'])->name('credit.cancel');
    Route::post('/buy_credits/{package}', [CreditController::class, 'buyCredits'])->name('credit.buy');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
