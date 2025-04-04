<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\QuestionApiController;

Route::get('/test', function () {
    return response()->json(['message' => 'API is working!']);
});
Route::get('/getquestion/{id}',  [QuestionApiController::class, 'show']);
Route::get('/checkanswer/{id}/{answer}',  [QuestionApiController::class, 'check']);




require __DIR__.'/auth.php';
