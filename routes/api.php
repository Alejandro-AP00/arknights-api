<?php

use App\Http\Controllers\Api\Operator\OperatorAlterController;
use App\Http\Controllers\Api\Operator\OperatorBaseController;
use App\Http\Controllers\Api\Operator\OperatorController;
use App\Http\Controllers\Api\Operator\OperatorHandbookController;
use App\Http\Controllers\Api\Operator\OperatorModuleController;
use App\Http\Controllers\Api\Operator\OperatorRiicController;
use App\Http\Controllers\Api\Operator\OperatorSkillController;
use App\Http\Controllers\Api\Operator\OperatorSkinController;
use App\Http\Controllers\Api\Operator\OperatorSummonController;
use App\Http\Controllers\Api\Operator\OperatorTalentController;
use App\Http\Controllers\Api\Operator\OperatorVoiceController;
use App\Http\Controllers\Api\Range\RangeController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');

Route::get('operators', [OperatorController::class, 'index']);
Route::get('operators/{character:char_id}', [OperatorController::class, 'show']);
Route::get('operators/{character:char_id}/all', [OperatorController::class, 'all']);

Route::get('operators/{character:char_id}/skills', [OperatorSkillController::class, 'index']);
Route::get('operators/{character:char_id}/skills/{skill:skill_id}', [OperatorSkillController::class, 'show']);

Route::get('operators/{character:char_id}/modules', [OperatorModuleController::class, 'index']);
Route::get('operators/{character:char_id}/modules/{module:module_id}', [OperatorModuleController::class, 'show']);

Route::get('operators/{character:char_id}/talents', [OperatorTalentController::class, 'index']);

Route::get('operators/{character:char_id}/handbook', [OperatorHandbookController::class, 'show']);

Route::get('operators/{character:char_id}/skins', [OperatorSkinController::class, 'index']);

Route::get('operators/{character:char_id}/voices', [OperatorVoiceController::class, 'index']);

Route::get('operators/{character:char_id}/riic', [OperatorRiicController::class, 'index']);

Route::get('operators/{character:char_id}/summons', [OperatorSummonController::class, 'index']);
Route::get('operators/{character:char_id}/summons/{summon:char_id}', [OperatorSummonController::class, 'show']);

Route::get('operators/{character:char_id}/alters', [OperatorAlterController::class, 'index']);
Route::get('operators/{character:char_id}/base', [OperatorBaseController::class, 'show']);


Route::get('ranges', [RangeController::class, 'index']);
Route::get('ranges/{range:range_id}', [RangeController::class, 'show']);
