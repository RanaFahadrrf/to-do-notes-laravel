<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NoteController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminAuthController;

Route::get('/user-signup', function () {
    return view('users-blades.signup');
})->name('user-signup');
Route::get('/', function () {
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
Route::get('/just-test',[UserController::class , 'test']);  //just for testing purpose.




Route::get('/notes-dashboard',[NoteController::class , 'index'])->name('notes-dashboard')->middleware('auth');
Route::resource('notes' , NoteController::class);
Route::get('/notes-recover',[NoteController::class , 'restore']);
Route::get('/show-deleted-notes',[NoteController::class , 'showDeletedNotes'])->name('show-deleted-notes');
Route::post('/restore-single-note/{id}',[NoteController::class , 'restoreSingleNote'])->name('restore-single-note');
Route::delete('/force-delete/{id}',[NoteController::class , 'forceDelete'])->name('force-delete');






//Below are the routes of admin
// admin-signup
Route::get('/admin/show-signup', [AdminAuthController::class, 'showSignup'])->name('admin-signup');
Route::post('/admin/signup', [AdminAuthController::class, 'processSignup'])->name('admin-process-signup');
Route::get('/admin/login', [AdminAuthController::class, 'showLogin'])->name('admin-login');
Route::post('/admin/login', [AdminAuthController::class, 'processLogin'])->name('admin-process-login');
Route::get('/admin/verify-otp', [AdminAuthController::class, 'showOtpForm'])->name('admin.otp');
Route::post('/admin/verify-otp', [AdminAuthController::class, 'verifyOtp']);
