<?php

use App\Http\Controllers\Api\Operator\OperatorController;
use App\Http\Controllers\Api\Operator\OperatorModuleController;
use App\Http\Controllers\Api\Operator\OperatorSkillController;
use App\Http\Controllers\Api\Operator\OperatorTalentController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');

Route::get('operators', [OperatorController::class, 'index']);
Route::get('operators/{character:char_id}', [OperatorController::class, 'show']);

Route::get('operators/{character:char_id}/skills', [OperatorSkillController::class, 'index']);
Route::get('operators/{character:char_id}/skills/{skill:skill_id}', [OperatorSkillController::class, 'show']);

Route::get('operators/{character:char_id}/modules', [OperatorModuleController::class, 'index']);
Route::get('operators/{character:char_id}/modules/{module:module_id}', [OperatorModuleController::class, 'show']);

Route::get('operators/{character:char_id}/talents', [OperatorTalentController::class, 'index']);
