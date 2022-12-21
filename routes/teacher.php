<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Teacher\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Teacher\Auth\ConfirmablePasswordController;
use App\Http\Controllers\Teacher\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\Teacher\Auth\EmailVerificationPromptController;
use App\Http\Controllers\Teacher\Auth\NewPasswordController;
use App\Http\Controllers\Teacher\Auth\PasswordController;
use App\Http\Controllers\Teacher\Auth\PasswordResetLinkController;
use App\Http\Controllers\Teacher\Auth\RegisteredUserController;
use App\Http\Controllers\Teacher\Auth\VerifyEmailController;
use App\Http\Controllers\Teacher\TeachersController;
use App\Http\Controllers\Teacher\StudentsController;
use App\Http\Controllers\Teacher\MyinfoController;
use App\Http\Controllers\Teacher\GuidanceReportsController;
use App\Http\Controllers\Teacher\ChatController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('teacher.welcome');
});

Route::get('/dashboard', function () {
    return view('teacher.dashboard');
})->middleware(['auth:teachers', 'verified'])->name('dashboard');

Route::get('students', [StudentsController::class, 'index'])
->middleware('auth:teachers')->name('students.index');

Route::resource('reports', GuidanceReportsController::class)
->middleware('auth:teachers');

// Route::resource('chats', ChatController::class)
// ->middleware('auth:teachers');

Route::prefix('chat')
->middleware('auth:teachers')
->group(function () {
    Route::get('show/{id}', [ChatController::class, 'show'])->name('chat.show');
    Route::post('send/{id}', [ChatController::class, 'send'])->name('chat.send');
});

Route::get('teachers', [TeachersController::class, 'index'])
->middleware('auth:teachers')->name('teachers.index');

Route::prefix('myinfo')
->middleware('auth:teachers')
->group(function () {
    Route::get('index', [MyinfoController::class, 'index'])->name('myinfo.index');
    Route::get('edit/{id}', [MyinfoController::class, 'edit'])->name('myinfo.edit');
    Route::post('update/{teacher}', [MyinfoController::class, 'update'])->name('myinfo.update');
});

Route::middleware('auth:teachers')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


Route::middleware('guest')->group(function () {
    Route::get('register', [RegisteredUserController::class, 'create'])
                ->name('register');

    Route::post('register', [RegisteredUserController::class, 'store']);

    Route::get('login', [AuthenticatedSessionController::class, 'create'])
                ->name('login');

    Route::post('login', [AuthenticatedSessionController::class, 'store']);

    Route::get('forgot-password', [PasswordResetLinkController::class, 'create'])
                ->name('password.request');

    Route::post('forgot-password', [PasswordResetLinkController::class, 'store'])
                ->name('password.email');

    Route::get('reset-password/{token}', [NewPasswordController::class, 'create'])
                ->name('password.reset');

    Route::post('reset-password', [NewPasswordController::class, 'store'])
                ->name('password.store');
});

Route::middleware('auth:teachers')->group(function () {
    Route::get('verify-email', [EmailVerificationPromptController::class, '__invoke'])
                ->name('verification.notice');

    Route::get('verify-email/{id}/{hash}', [VerifyEmailController::class, '__invoke'])
                ->middleware(['signed', 'throttle:6,1'])
                ->name('verification.verify');

    Route::post('email/verification-notification', [EmailVerificationNotificationController::class, 'store'])
                ->middleware('throttle:6,1')
                ->name('verification.send');

    Route::get('confirm-password', [ConfirmablePasswordController::class, 'show'])
                ->name('password.confirm');

    Route::post('confirm-password', [ConfirmablePasswordController::class, 'store']);

    Route::put('password', [PasswordController::class, 'update'])->name('password.update');

    Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])
                ->name('logout');
});
