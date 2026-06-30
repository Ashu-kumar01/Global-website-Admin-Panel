<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\ChangePasswordController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\RibbonController;
use App\Http\Controllers\LandingSectionController;
use App\Http\Controllers\AboutSectionController;
use App\Http\Controllers\WhyChooseUsController;
use App\Http\Controllers\CourseSectionController;
use App\Http\Controllers\AdmissionProcessController;
use App\Http\Controllers\PlacementController;
use App\Http\Controllers\HomeBuilderController;
use App\Http\Controllers\SitePreviewController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('/register', function () {
    return view('register');
})->name('register');

Route::post('/register', [UserController::class, 'store'])->name('save.register');


Route::get('/login', [LoginController::class, 'showForm'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.submit');
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard')->middleware('auth');

// Route::get('/profile', function () {
//     return view('admin.profile');
// })->name('admin.profile')->middleware('auth');

Route::prefix('admin')->middleware('auth')->group(function () {
    Route::get('/menu', [MenuController::class, 'index'])->name('admin.menu');
    Route::post('/menu', [MenuController::class, 'store'])->name('admin.menu.store');
    Route::get('/ribbon', [RibbonController::class, 'index'])->name('admin.ribbon');
    Route::post('/ribbon/save', [RibbonController::class, 'store'])->name('admin.ribbon.save');
    Route::get('/landing-sections', [LandingSectionController::class, 'index'])->name('admin.landing-sections');
    Route::post('/landing-sections', [LandingSectionController::class, 'store'])->name('admin.landing-sections.store');
    Route::get('/about-section', [AboutSectionController::class, 'index'])->name('admin.about-section');
    Route::post('/about-section', [AboutSectionController::class, 'store'])->name('admin.about-section.store');
    Route::get('/why-choose-us', [WhyChooseUsController::class, 'index'])->name('admin.WhyChooseUs');
    Route::post('/why-choose-us', [WhyChooseUsController::class, 'store'])->name('admin.WhyChooseUs.store');
    Route::get('/courses', [CourseSectionController::class, 'index'])->name('admin.courses');
    Route::post('/courses', [CourseSectionController::class, 'store'])->name('admin.courses.store');
    Route::get('/admission-process', [AdmissionProcessController::class, 'index'])->name('admin.admission-process');
    Route::post('/admission-process', [AdmissionProcessController::class, 'store'])->name('admin.admission-process.store');
    Route::get('/placement', [PlacementController::class, 'index'])->name('admin.placement');
    Route::post('/placement', [PlacementController::class, 'store'])->name('admin.placement.store');

    Route::get('/home-builder', [HomeBuilderController::class, 'index'])->name('admin.home-builder');
    Route::post('/home-builder/selection', [HomeBuilderController::class, 'saveSelection'])->name('admin.home-builder.selection');
    Route::post('/home-builder/sections/{key}/configure', [HomeBuilderController::class, 'configureSection'])->name('admin.home-builder.configure');
    Route::post('/home-builder/draft', [HomeBuilderController::class, 'saveDraft'])->name('admin.home-builder.draft');
    Route::post('/home-builder/publish', [HomeBuilderController::class, 'publish'])->name('admin.home-builder.publish');
    
    Route::get('/preview', [SitePreviewController::class, 'index'])->name('admin.preview');
    Route::get('/profile', [ProfileController::class, 'index'])->name('admin.profile');
    Route::post('/profile/save', [ProfileController::class, 'store'])->name('admin.profile.save');
    Route::get('/password', [ChangePasswordController::class, 'index'])->name('admin.password.edit');
    Route::post('/password', [ChangePasswordController::class, 'updatePassword'])->name('admin.password.update');
    Route::get('/account-settings', [ProfileController::class, 'accountSettings'])->name('admin.account-settings');
});

Route::get('/articles/blue', function () {
    return view('articals.blue.index');
})->name('articles.blue');


// Password reset stub — wire up Laravel's built-in if needed
Route::get('/forgot-password', function () {
    return redirect()->route('login');
})->name('password.request');
