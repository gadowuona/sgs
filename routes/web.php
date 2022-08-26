<?php

use App\Http\Controllers\FinanceController;
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


Route::middleware(['auth', 'authstaffcheck'])->group(function () {
    Route::resource('supervisors', SupervisorConteroller::class);
    Route::resource('students', StudentController::class);
    Route::resource('thesis', ThesisController::class);
});

// Admin Routes 
Route::middleware(['auth', 'authcheck'])->group(function () {
    Route::group(['prefix' => 'admin'], function () {
        Route::resource('users', UserController::class);
    });
});
Route::middleware(['auth', 'authfin'])->group(function () {
    Route::group(['prefix' => 'finance'], function () {
        Route::get('thesis', [FinanceController::class, 'index'])->name('finance.thesis.index');
        Route::get('thesis/{thesi}', [FinanceController::class, 'show'])->name('finance.thesis.show');
    });
});




// Staff Routes
Route::middleware(['auth', 'authstaff'])->group(function () {
    Route::group(['prefix' => 'staff'], function () {
        Route::get('thesis', [SupervisorStaffController::class, 'index'])->name('staff.thesis.index');
        Route::get('thesis/{thesi}', [SupervisorStaffController::class, 'show'])->name('staff.thesis.show');
    });
});


Route::get('/all/students', function () {
    return Student::all();
})->name('students.all');