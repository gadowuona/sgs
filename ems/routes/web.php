<?php

use App\Http\Controllers\StudentController;
use App\Http\Controllers\SupervisorConteroller;
use App\Http\Resources\UserCollection;
use App\Models\User;
use Illuminate\Support\Facades\Route;


require __DIR__ . '/auth.php';

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');


Route::resource('supervisors', SupervisorConteroller::class)->middleware(['auth']);
Route::resource('students', StudentController::class)->middleware(['auth']);


// Route::get('/users', function () {
//     return new UserCollection(User::all());
// })->name('users.index');