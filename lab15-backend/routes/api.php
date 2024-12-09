<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\BookController;

Route::get('/csrf-token', [BookController::class, 'getCsrfToken']);

Route::apiResource('/book', BookController::class);
