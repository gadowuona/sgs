<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\SupervisorConteroller;
use App\Http\Controllers\SupervisorStaffController;
use App\Http\Controllers\ThesisController;
use App\Models\Student;
use Illuminate\Support\Facades\Route;


require __DIR__ . '/auth.php';

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth',])->name('dashboard');


Route::resource('supervisors', SupervisorConteroller::class)->middleware(['auth']);
Route::resource('students', StudentController::class)->middleware(['auth']);
Route::resource('thesis', ThesisController::class)->middleware(['auth']);

// Admin Routes 
Route::middleware(['auth','authcheck'])->group(function () {
    Route::group(['prefix' => 'admin'], function () {
        Route::resource('users', UserController::class);
    });
});


Route::middleware(['auth'])->group(function () {
Route::group(['prefix' => 'staff'], function () {
    Route::get('theses', [SupervisorStaffController::class, 'index'])->name('staff.thesis.index');
});
});


Route::get('/all/students', function () {
    return Student::all();
})->name('students.all');