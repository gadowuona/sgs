<?php

use App\Http\Controllers\SupervisorConteroller;
use Illuminate\Support\Facades\Route;


require __DIR__ . '/auth.php';

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');


Route::resource('supervisors', SupervisorConteroller::class)->middleware(['auth']);