<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;
use App\Http\Controllers\BorrowerController;
use App\Http\Controllers\LoanController;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::apiResource('books', BookController::class);

Route::apiResource('borrowers', BorrowerController::class);

Route::post('/loans/borrow', [LoanController::class, 'borrow']);      
Route::post('/loans/return/{id}', [LoanController::class, 'returnBook']); 
