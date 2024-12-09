<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\BookController;

Route::get('/', function () {
    return view('welcome');
});

Route::apiResource('/book', BookController::class);
Route::get('/csrf-token', function () {
    return response()->json(['csrf_token' => csrf_token()]);
});