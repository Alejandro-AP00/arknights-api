<?php

use App\Http\Controllers\Api\OperatorController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');

Route::get('operators', [OperatorController::class, 'index']);
Route::get('operators/{character:char_id}', [OperatorController::class, 'show']);
