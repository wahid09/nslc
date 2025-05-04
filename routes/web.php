<?php

use App\Http\Controllers\PollController;
use App\Models\Footer;
use App\Models\SociaLinkl;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\ProductController;
use App\Http\Controllers\Frontend\AboutUsController;
use App\Http\Controllers\Frontend\NoticeController;
use App\Http\Controllers\Frontend\SapoxController;
use App\Http\Controllers\Frontend\childrenClubController;
use App\Http\Controllers\Frontend\LadicClubController;
use App\Http\Controllers\Frontend\PublicationController;
use App\Http\Controllers\Frontend\RegisterUserController;
use App\Http\Controllers\Frontend\ProfileUpdateController;
use Spatie\Csp\AddCspHeaders;

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

//Route::get('/', function () {
//    return view('welcome');
//});
Route::get('/clear_cache', function () {
    Artisan::call('route:clear');
    Artisan::call('cache:clear');
    Artisan::call('config:clear');
    Artisan::call('config:cache');
    Artisan::call('view:clear');
    return 'Clear Cache';
});
Route::group(['middleware' => ['auth', '2fa']], function () {
    Route::get('/', [HomeController::class, 'index']);
    Route::get('/our-products', [ProductController::class, 'index']);
    Route::get('/our-products/{catId}/{areaId}', [ProductController::class, 'getProduct']);
    Route::get('/discount-products/{catId}/{areaId}', [ProductController::class, 'discuntProduct']);
    Route::get('/about-us', [AboutUsController::class, 'index']);
    Route::get('/bani', [HomeController::class, 'getBani']);
    Route::get('/notice', [NoticeController::class, 'index']);
    Route::get('/notice/{id}', [NoticeController::class, 'detailsNotice']);
    Route::get('/sapox', [SapoxController::class, 'index']);
    Route::get('/about-sapox', [SapoxController::class, 'aboutSapox']);
    Route::get('/showroome-sapox/{id}', [SapoxController::class, 'shawroomeSapox']);
    Route::get('details-sapox/{id}', [SapoxController::class, 'detailsSapox']);
    Route::get('gallery-sapox/{id}', [SapoxController::class, 'gallerySapox']);
    Route::get('product-sapox/{id}', [SapoxController::class, 'productSapox']);
    Route::get('calender-sapox/{id}', [SapoxController::class, 'calenderSapox']);
    Route::get('kolkontho-club/{id}', [SapoxController::class, 'kolkonthoClub']);
    Route::get('others/{id}', [SapoxController::class, 'others']);
    Route::get('/policy', [SapoxController::class, 'policy'])->name('policy.index');
    Route::get('/corected-policy', [SapoxController::class, 'corectedPolicy'])->name('corected-policy.index');
    Route::get('/filedpwmload/{file_name}', [SapoxController::class, 'download']);

    Route::get('/notice-download/{file_name}', [NoticeController::class, 'getFile']);

    Route::get('/about-childrenclub', [childrenClubController::class, 'aboutChildrenclub']);
    Route::get('/home-childrenclub', [childrenClubController::class, 'index']);
    Route::get('/details-childrenclub/{id}', [childrenClubController::class, 'detailsChildrenclub']);
    Route::get('/childrenclub-gallery/{id}', [childrenClubController::class, 'childrenclubGallery']);
    Route::get('/childrenclubpdf/{file_name}', [childrenClubController::class, 'download']);
    Route::get('/childrenclub-calender/{id}', [childrenClubController::class, 'childrenclubCalender']);

    Route::get('/about-ladisclub', [LadicClubController::class, 'aboutLadisclub']);
    Route::get('/ladies-club', [LadicClubController::class, 'index']);
    Route::get('/details-ladiesclub/{id}', [LadicClubController::class, 'detailsLadiesClub']);
    Route::get('/ladiesclub-gallery/{id}', [LadicClubController::class, 'ladiesclubGallery']);
    Route::get('/ladiesclubpdf/{file_name}', [LadicClubController::class, 'download']);
    Route::get('/protiva-school/{id}', [LadicClubController::class, 'protivaSchool']);
    Route::get('/ladiesclub-calender/{id}', [LadicClubController::class, 'ladiesclubCalender']);
    Route::get('/notice-ladiesclub/{id}', [LadicClubController::class, 'ladiesClubNotice']);
    Route::get('/notice-childrenclub/{id}', [childrenClubController::class, 'childrenClubNotice']);

    //Publication
    Route::get('/publication', [PublicationController::class, 'index']);
    Route::get('/files/{file_name}', [PublicationController::class, 'download']);
    //Profile Change
    Route::get('user-profile', [ProfileUpdateController::class, 'getProfileView']);
    Route::get('user-profile-update', [ProfileUpdateController::class, 'getProfileUpdate']);
    Route::post('user-profile-updated', [ProfileUpdateController::class, 'getProfileUpdated']);
    Route::get('password-view', [ProfileUpdateController::class, 'getPasswordView']);
    Route::post('password-change', [ProfileUpdateController::class, 'passwordUpdate']);
    // Poll Login Route
    Route::get('PollLogin', [PollController::class, 'PollLogin'])->name('PollLogin');
});
Route::get('/user-register', [RegisterUserController::class, 'create'])->name('register.create');
Route::post('/user-register', [RegisterUserController::class, 'store'])->name('register.store');
Route::get('/course-list', [SapoxController::class, 'courseList'])->name('course.list');
Route::get('/course-result', [SapoxController::class, 'courseResult'])->name('course.result');
Route::get('/result-download/{file_name}', [SapoxController::class, 'getFile']);



Auth::routes();
//Route::view('/dashboard', 'backend.dashboard');

//Route::get('/home', 'HomeController@index')->name('home');
Route::get('/home', [HomeController::class, 'index'])->name('home')->middleware('2fa');
Route::get('2fa', [App\Http\Controllers\TwoFAController::class, 'index'])->name('2fa.index');
Route::post('2fa', [App\Http\Controllers\TwoFAController::class, 'store'])->name('2fa.post');
Route::get('2fa/reset', [App\Http\Controllers\TwoFAController::class, 'resend'])->name('2fa.resend');
Route::get('/member-application-form', [\App\Http\Controllers\LadiesClub\MemberRegistration::class, 'memberApplicationFrom'])->name('application.form');
Route::post('/member-application-form', [\App\Http\Controllers\LadiesClub\MemberRegistration::class, 'memberApplicationProcess'])->name('application.store');

View::composer('layouts.frontend.partials.footer', function ($view) {
    $footer = Footer::first();
    $view->with('footer', $footer);
});
View::composer('layouts.frontend.partials.footer', function ($view) {
    $socile = SociaLinkl::first();
    $view->with('socile', $socile);
});
View::composer('layouts.frontend.partials.header', function ($view) {
    $footer = Footer::first();
    $view->with('footer', $footer);
});
View::composer('layouts.frontend.partials.header', function ($view) {
    $file = \App\Models\Policy::all();
    $view->with('file', $file);
});
