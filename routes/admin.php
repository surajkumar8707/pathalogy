<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\Auth\LoginController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\AttendanceController;
use App\Http\Controllers\Admin\TempraryImageController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\CustomerController;
use App\Http\Controllers\Admin\HomePageCarouselController;

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
|
| Here is where you can register Admin routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "Admin" middleware group. Make something great!
|
*/

// Admin routes
Route::get('/login', [LoginController::class, 'showAdminLoginForm'])->name('login.form');
Route::post('/login', [LoginController::class, 'adminLogin'])->name('login.post');
Route::post('/logout', [LoginController::class, 'adminLogout'])->name('logout');

// Authenticated routes
Route::middleware('role:admin')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
    Route::get('/cache-clear', [AdminController::class, 'cacheClear'])->name('cache.clear')->middleware('web');

    // Pages
    Route::group(['prefix' => '/temporary-image', 'as' => 'temporary.image.'], function () {
        Route::post('/upload', [TempraryImageController::class, 'uploadTemporaryImage'])->name('upload');
        Route::get('/get/{id?}', [TempraryImageController::class, 'getTemporaryImage'])->name('get');
    });

    Route::get('/profile', [AdminController::class, 'profile'])->name('profile');
    Route::post('/profile', [AdminController::class, 'profileUpdate'])->name('profile.update');
    Route::get('/change-password', [AdminController::class, 'changePassword'])->name('password');
    Route::post('/update-password', [AdminController::class, 'updatePassword'])->name('update.password');
    Route::get('/setting', [AdminController::class, 'setting'])->name('setting');
    Route::post('/setting-update/{id}', [AdminController::class, 'settingUpdate'])->name('setting.update');

    Route::get('/contacts', [AdminController::class, 'contacts'])->name('contacts');
    Route::get('/bookings', [AdminController::class, 'bookings'])->name('bookings');

    // Student routes
    Route::group(['prefix' => '/students', 'as' => 'students.'], function () {
        Route::get('/', [\App\Http\Controllers\Admin\UserController::class, 'index'])->name('index');
        Route::get('/create', [\App\Http\Controllers\Admin\UserController::class, 'create'])->name('create');
        Route::post('/store', [\App\Http\Controllers\Admin\UserController::class, 'store'])->name('store');
        Route::get('/edit/{id}', [\App\Http\Controllers\Admin\UserController::class, 'edit'])->name('edit');
        Route::put('/update/{id}', [\App\Http\Controllers\Admin\UserController::class, 'update'])->name('update');
        Route::get('/delete/{id}', [\App\Http\Controllers\Admin\UserController::class, 'destroy'])->name('destroy');
        Route::post('/change-status', [\App\Http\Controllers\Admin\UserController::class, 'changeStatus'])->name('change.status');
    });

    // attendances
    Route::group(['prefix' => '/attendances', 'as' => 'attendances.'], function () {
        Route::get('/', [AttendanceController::class, 'list'])->name('list');
        Route::post('/save-attendance', [AttendanceController::class, 'saveAttendance'])->name('save.attendance');
        // Route::get('/our-room', [AttendanceController::class, 'ourRoomPage'])->name('our.room');
        // Route::get('/gallery', [AttendanceController::class, 'galleryPage'])->name('gallery');
    });

    Route::get('/social-media', [AdminController::class, 'socialMedia'])->name('social.media');
    Route::post('/social-media-update/{id}', [AdminController::class, 'socialMediaUpdate'])->name('social.media.update');

    // Pages
    Route::group(['prefix' => '/pages', 'as' => 'pages.'], function () {
        Route::get('/about', [AdminController::class, 'aboutPage'])->name('about');
        Route::get('/our-room', [AdminController::class, 'ourRoomPage'])->name('our.room');
        Route::get('/gallery', [AdminController::class, 'galleryPage'])->name('gallery');
    });

    Route::resource('home-page-carousel', HomePageCarouselController::class);
    Route::post('/change-status', [HomePageCarouselController::class, 'changeStatus'])->name('change.status');
});
