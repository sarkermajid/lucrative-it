<?php

use App\Http\Controllers\Admin\AjaxController;
use App\Http\Controllers\Admin\Auth\LoginController;
use App\Http\Controllers\Admin\ClientReviewController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Admin\PagesController;
use App\Http\Controllers\admin\PortfolioController;
use App\Http\Controllers\Admin\ServicesController;
use App\Http\Controllers\Admin\SettingsController;
use App\Http\Controllers\Admin\SlidersController;
use App\Http\Controllers\Admin\UsersController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

Auth::routes();

/*admin routes*/

Route::get('admin/login', [LoginController::class, 'showLoginForm']);
Route::post('admin/login', [LoginController::class, 'login']);

Route::group(['middleware' => 'admin', 'prefix' => 'admin'], function () {

    Route::get('/', [HomeController::class, 'dashboard'])->name('dashboard');

    Route::resource('users', UsersController::class);
    Route::get('profile/{id}', [UsersController::class, 'show']);
    Route::get('profile-edit/{id}', [UsersController::class, 'profile_edit']);
    Route::post('profile-update', [UsersController::class, 'profile_update']);


    Route::resource('sliders', SlidersController::class);
    Route::resource('services', ServicesController::class);

    Route::get('admin/services/edit/{id}', [ServicesController::class, 'edit'])->name('services.edit');

    Route::get('add-type', [PortfolioController::class, 'addType'])->name('addType');
    Route::post('add-type-store',[PortfolioController::class, 'storeType'])->name('storeType');
    Route::get('add-type-list',[PortfolioController::class, 'typeList'])->name('typeList');
    Route::get('add-type-list/{id}', [PortfolioController::class, 'typeEdit'])->name('typeEdit');
    Route::PUT('add-type-update/{id}', [PortfolioController::class, 'typeUpdate'])->name('typeUpdate');
    Route::delete('add-type-delete/{id}', [PortfolioController::class, 'typeDelete'])->name('typeDelete');


    Route::get('add-portfolio', [PortfolioController::class, 'addPortfolio'])->name('addPortfolio');
    Route::post('add-portfolio-store', [PortfolioController::class, 'storePortfolio'])->name('storePortfolio');
    Route::get('add-portfolio-list', [PortfolioController::class, 'typePortfolioList'])->name('typePortfolioList');
    Route::get('add-portfolio-list/{id}', [PortfolioController::class, 'typePortfolioEdit'])->name('typePortfolioEdit');
    Route::PUT('add-portfolio-update/{id}', [PortfolioController::class, 'typePortfolioUpdate'])->name('typePortfolioUpdate');
    Route::delete('add-portfolio-delete/{id}', [PortfolioController::class, 'typePortfolioDelete'])->name('typePortfolioDelete');

    Route::get('add-review', [ClientReviewController::class, 'addReview'])->name('addReview');
    Route::post('add-review-store',[ClientReviewController::class, 'storeReview'])->name('storeReview');
    Route::get('review-list',[ClientReviewController::class, 'reviewList'])->name('reviewList');
    Route::get('review-edit/{id}', [ClientReviewController::class, 'reviewEdit'])->name('reviewEdit');
    Route::put('review-update/{id}', [ClientReviewController::class, 'reviewUpdate'])->name('reviewUpdate');
    Route::delete('review-delete/{id}', [ClientReviewController::class, 'reviewDelete'])->name('reviewDelete');

    Route::resource('pages', PagesController::class);




    Route::get('system-settings', [SettingsController::class, 'system_settings']);
    Route::post('system-settings', [SettingsController::class, 'system_settings_update']);


    Route::post('logout', [LoginController::class, 'logout']);

});

/*admin ajax*/
Route::post('extra-fields', [AjaxController::class, 'extra_fields']);


Route::get('password/change/{id}', [UsersController::class, 'password_change']);
Route::post('password/change', [UsersController::class, 'password_update']);


// Authentication Routes
Route::get('login', [LoginController::class, 'showLoginForm'])->name('auth.login');
Route::post('login', [LoginController::class, 'login'])->name('auth.login');
Route::post('logout', [LoginController::class, 'logout'])->name('auth.logout');

// Change Password Routes
// Route::get('change_password', [ChangePasswordController::class, 'showChangePasswordForm'])->name('auth.change_password');
// Route::patch('change_password', [ChangePasswordController::class, 'changePassword'])->name('auth.change_password');

// Password Reset Routes
Route::get('password/reset', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('auth.password.reset');
Route::post('password/email', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('auth.password.email');
Route::get('password/reset/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
Route::post('password/reset', [ResetPasswordController::class, 'reset'])->name('auth.password.update');


/*site url*/
Route::get('/', [HomeController::class, 'index']);
Route::get('services', [HomeController::class, 'services']);
Route::get('contact', [HomeController::class, 'contact']);
Route::get('about', [HomeController::class, 'about']);

Route::get('registration', [HomeController::class, 'registration']);
Route::post('registration-form', [HomeController::class, 'registration_submit']);
Route::get('registration-second', [HomeController::class, 'registration_second']);
Route::post('registration-final-submit', [HomeController::class, 'registration_final_submit']);




Route::get('user/activate/{id}', [HomeController::class, 'activate']);



Route::get('myprofile', [ProfileController::class, 'myprofile']);
Route::get('myprofile-edit', [ProfileController::class, 'myprofile_edit']);
Route::post('myprofile-update', [ProfileController::class, 'myprofile_update']);


Route::get('sitemap', function (){
    \Illuminate\Support\Facades\App::make("sitemap");
});
