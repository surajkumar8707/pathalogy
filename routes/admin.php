<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\Auth\LoginController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\AttendanceController;
use App\Http\Controllers\Admin\TempraryImageController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\CustomerController;
use App\Http\Controllers\Admin\HomePageCarouselController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\SubCategoryController;
use App\Http\Controllers\Admin\TestController;
use App\Http\Controllers\Admin\ReportController;
use App\Http\Controllers\Admin\ReportSettingController;

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

    Route::resource('categories', CategoryController::class);
    Route::resource('sub-categories', SubCategoryController::class);
    Route::resource('tests', TestController::class);

    Route::resource('report', ReportController::class);
    Route::group(['prefix' => '/report', 'as' => 'report.'], function () {
        Route::post('/store', [ReportController::class, 'store'])->name('store');
        Route::get('/generate-report/{report_id}', [ReportController::class, 'generateReport'])->name('generate.report');
        Route::get('/receipt-report/{report_id}', [ReportController::class, 'receiptReport'])->name('receipt.report');
        Route::post('/save-single-test', [ReportController::class, 'saveSingleTest'])->name('save.single.test');
        Route::post('/fetch-subcategory', [ReportController::class, 'fetchSubcategory'])->name('fetch.subcategory');
        Route::post('/fetch-test', [ReportController::class, 'fetchTest'])->name('fetch.test');
        Route::get('/view/{report_id}', [ReportController::class, 'viewReport'])->name('view.report');
        Route::post('/update-lower-value', [ReportController::class, 'updateLowerValue'])->name('update.lower.value');
        Route::post('save/all/lower/values', [ReportController::class, 'saveAllLowerValues'])->name('save.all.lower.values');
    });
    Route::get('/report-setting', [ReportSettingController::class, 'index'])->name('report.setting');
    Route::post('/report-setting/settings/update/{id}', [ReportSettingController::class, 'settingUpdate'])->name('report.setting.update');
});
