<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Auth\PasswordResetController;
use App\Http\Controllers\Auth\VerifyEmailController;
use App\Http\Controllers\CarTypeController;
use App\Http\Controllers\CityController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DriverController;
use App\Http\Controllers\DriverPermissionController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\RolePermissionController;
use App\Jobs\LoggingJob;
use App\Mail\WelcomeEmail;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Password;

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
    return view('welcome');
});

Route::prefix('cms/')->middleware('guest:admin,driver')->group(function(){
    Route::get('{guard}/login', [AuthController::class, 'showLogin'])->name('auth.login');
    Route::post('login', [AuthController::class, 'login']);
});

#************************************************************
Route::get('/cms/forgot-password', [PasswordResetController::class, 'requestPassword'])->middleware('guest')->name('password.request');
Route::post('/cms/forgot-password', [PasswordResetController::class, 'forgotPassword'])->middleware('guest')->name('password.email');
Route::get('reset-password/{token}', [PasswordResetController::class, 'resetPassword'])->middleware('guest')->name('password.reset');
Route::post('reset-password', [PasswordResetController::class, 'updatePassword'])->middleware('guest')->name('password.update');
#************************************************************

Route::prefix('email')->middleware('auth:admin')->group(function(){
    Route::get('verify', [VerifyEmailController::class, 'notice'])->name('verification.notice');
    Route::get('verify/{id}/{hash}', [VerifyEmailController::class, 'verify'])->middleware(['signed'])->name('verification.verify');
    Route::post('verification-notification', [VerifyEmailController::class, 'send'])->middleware(['throttle:6,1'])->name('verification.send');
});

Route::prefix('cms/admin')->middleware(['auth:admin', 'verified'])->group(function(){
    Route::resource('admins', AdminController::class);
    Route::resource('drivers', DriverController::class);
    Route::resource('roles', RoleController::class);
    Route::resource('permissions', PermissionController::class);
    // Route::resource('permission/role', RolePermissionController::class);
    Route::post('role/{role}/permission', [RolePermissionController::class, 'store']);
    Route::get('driver/{driver}/permission', [DriverPermissionController::class, 'show'])->name('driver-permissions.show');
    Route::post('driver/{driver}/permission', [DriverPermissionController::class, 'store'])->name('driver-permissions.store');
});
Route::prefix('cms/admin')->middleware(['auth:admin,driver', 'verified'])->group(function(){
    // Route::get('/{locale?}', [DashboardController::class, 'showDashboard']);
    Route::get('/', [DashboardController::class, 'showDashboard']);
    Route::get('change-language/{lang}', [DashboardController::class, 'changeLanguage'])->name('change-language');
    Route::resource('cities', CityController::class);
    Route::resource('car-types', CarTypeController::class);

    Route::get('edit-password', [AuthController::class, 'editPassword'])->name('auth.edit-password');
    Route::put('update-password', [AuthController::class, 'updatePassword'])->name('auth.update-password');

    Route::get('edit-profile', [AuthController::class, 'editProfile'])->name('auth.edit-profile');
    Route::put('update-profile', [AuthController::class, 'updateProfile'])->name('auth.update-profile');

    Route::view('notifications', 'cms.notifications.index')->name('cms.notifications');
    Route::get('notifications-read/{id}', [NotificationController::class, 'markAsRead'])->name('cms.notifications.read');
    Route::delete('notifications/{id}', [NotificationController::class, 'destroy'])->name('cms.notifications.destroy');
    
    Route::get('logout', [AuthController::class, 'logout'])->name('auth.logout');
});

Route::get('email', function(){
    return new WelcomeEmail();
});

Route::get('/greeting/{locale}', function ($locale) {
    if (! in_array($locale, ['en', 'ar'])) {
        abort(400);
    }
 
    App::setLocale($locale);
    $locale = App::currentLocale();
 
    //
});

Route::get('job', function(){
    // logger('Laravel 10 LOG(1) - Logging');
    // logger('Laravel 10 LOG(2) - Logging');
    // logger('Laravel 10 LOG(3) - Logging');

    // dispatch(function(){
    //     logger('DISPATCHED JOB - Laravel 10 LOG(1) - Logging');
    // })->onQueue('Logging Queue')->delay(3);

    // dispatch(new LoggingJob())->delay(3);

    LoggingJob::dispatch()->onQueue('Email')->delay(3);
    LoggingJob::dispatch()->onQueue('Logging')->delay(8);
});
