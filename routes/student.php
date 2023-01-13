<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Student\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Student\Auth\ConfirmablePasswordController;
use App\Http\Controllers\Student\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\Student\Auth\EmailVerificationPromptController;
use App\Http\Controllers\Student\Auth\NewPasswordController;
use App\Http\Controllers\Student\Auth\PasswordController;
use App\Http\Controllers\Student\Auth\PasswordResetLinkController;
use App\Http\Controllers\Student\Auth\RegisteredUserController;
use App\Http\Controllers\Student\Auth\VerifyEmailController;
use App\Http\Controllers\Student\TeachersController;
use App\Http\Controllers\Student\GuidanceReportsController;
use App\Http\Controllers\Student\ChatController;
use App\Http\Controllers\Student\MyinfoController;
use App\Http\Controllers\Student\QuestionnaireController;
use App\Http\Controllers\Student\TodoController;
use App\Http\Controllers\Student\NoticeController;


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

// Route::get('/', function () {
//     return view('student.welcome');
// });

Route::get('/', function () {
    return redirect()->route('student.myinfo.show');
})->middleware('auth:students');

Route::get('/dashboard', function () {
    return view('student.dashboard');
})
    //⇓ここで認証してるか確認。
    ->middleware(['auth:students', 'verified'])->name('dashboard');

Route::prefix('myinfo')
    ->middleware('auth:students')
    ->group(function () {
        Route::get('show', [MyinfoController::class, 'show'])->name('myinfo.show');
        Route::get('edit/{id}', [MyinfoController::class, 'edit'])->name('myinfo.edit');
        Route::post('update/{id}', [MyinfoController::class, 'update'])->name('myinfo.update');
    });

Route::get('teachers', [TeachersController::class, 'index'])
    ->middleware('auth:students')->name('teachers.index');

Route::resource('reports', GuidanceReportsController::class)
    ->middleware('auth:students');

Route::prefix('questionnaire')
    ->middleware('auth:students')
    ->group(function () {
        Route::get('edit/{report_id}', [QuestionnaireController::class, 'edit'])->name('questionnaire.edit');
        Route::post('update/{id}', [QuestionnaireController::class, 'update'])->name('questionnaire.update');
    });

Route::prefix('chat')
    ->middleware('auth:students')
    ->group(function () {
        Route::get('show/{id}', [ChatController::class, 'show'])->name('chat.show');
        // Route::get('add/{id}', [ChatController::class, 'add'])->name('chat.add');
        Route::post('send/{id}', [ChatController::class, 'send'])->name('chat.send');
    });

Route::prefix('todo')
    ->middleware('auth:students')
    ->group(function () {
        Route::get('show', [TodoController::class, 'show'])->name('todo.show');
    });

Route::prefix('notice')
    ->middleware('auth:students')
    ->group(function () {
        Route::get('index', [NoticeController::class, 'index'])->name('notice.index');
        Route::get('show/{id}', [NoticeController::class, 'show'])->name('notice.show');
    });

Route::middleware('auth:students')->group(function () {
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

Route::middleware('auth:students')->group(function () {
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
