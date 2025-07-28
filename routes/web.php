<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NoteController;
use App\Http\Controllers\UserController;

Route::get('/', function () {
    return view('users-blades.signup');
})->name('user-signup');
Route::get('/login-page', function () {
    return view('users-blades.login');
})->name('login-page');
// Route::get('/notes-dashboard', function () {
//     return view('users-blades.notes-dashboard');
// })->name('notes-dashboard');
Route::get('/add-note', function () {
    return view('users-blades.addnote');
})->name('add-note');




Route::get('/show',[UserController::class , 'show']);
Route::post('/sign-up',[UserController::class , 'signup'])->name('signup');
Route::post('/login',[UserController::class , 'login'])->name('login');
Route::get('/logout',[UserController::class , 'logout'])->name('logout');


Route::get('/notes-dashboard',[NoteController::class , 'index'])->name('notes-dashboard')->middleware('auth');
Route::resource('notes' , NoteController::class);