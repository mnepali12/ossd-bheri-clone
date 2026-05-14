<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware('auth:sanctum')->group(function () {
    Route::apiResource('announcements', \App\Http\Controllers\AnnouncementController::class);
    Route::apiResource('documents', \App\Http\Controllers\DocumentController::class);
    Route::apiResource('results', \App\Http\Controllers\ResultController::class);
    Route::apiResource('feedbacks', \App\Http\Controllers\FeedbackController::class);
});
