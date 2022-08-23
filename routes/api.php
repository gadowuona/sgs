<?php

use App\Http\Controllers\Api\StudentController;
use App\Http\Controllers\Api\SupervisorController;
use App\Http\Controllers\Api\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::name('api.')->prefix('all')->group(function () {
    // Route::get('/users', UserController::class)->name('users.index');
    Route::get('supervisor', SupervisorController::class)->name('supervisor');
    Route::get('students', StudentController::class)->name('student');
});