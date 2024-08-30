<?php

use App\Http\Controllers\AskController;
use Illuminate\Support\Facades\Route;

Route::post('ask', [AskController::class, '__invoke']);
// ->middleware('auth:sanctum');
