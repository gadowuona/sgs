<?php

use App\Http\Controllers\UserConteroller;
use Illuminate\Support\Facades\Route;


require __DIR__ . '/auth.php';

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');


Route::resource('users', UserConteroller::class)->middleware(['auth']);