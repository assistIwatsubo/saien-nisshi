<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\DiaryController;
use App\Http\Controllers\CropFieldController;
use App\Http\Controllers\FieldController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PlanController;
use App\Http\Controllers\LayoutController;


Route::post('login', [AuthController::class, 'login']);
Route::post('refresh', [AuthController::class, 'refresh']);

Route::middleware('jwt.auth')->group(function () {

    Route::post('logout', [AuthController::class, 'logout']);
    Route::get('me', [AuthController::class, 'me']);


    Route::apiResource('users', UserController::class);

    Route::get('users/followings', [UserController::class, 'followings']); 
    Route::get('users/followings/latest-diaries', [UserController::class, 'followingsWithLatestDiary']); 

    
    Route::apiResource('schedules', ScheduleController::class);

    Route::apiResource('diaries', DiaryController::class);
    Route::get('diaries/today', [DiaryController::class, 'today']);

    Route::apiResource('fields', FieldController::class);

    Route::apiResource('plans', PlanController::class);
    
    Route::apiResource('field-crops', CropFieldController::class);
    
    Route::apiResource('layouts', LayoutController::class);


    Route::get('followers', [UserController::class, 'followers']);


});