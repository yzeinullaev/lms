<?php

use App\Http\Controllers\Admin\BlockItemsController;
use App\Http\Controllers\Admin\CitiesController;
use App\Http\Controllers\Admin\CourseLessonsController;
use App\Http\Controllers\Admin\CourseProgramsController;
use App\Http\Controllers\Admin\NewsController;
use App\Http\Controllers\Admin\PageItemsController;
use App\Http\Controllers\Admin\TariffItemsController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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
    return view('vendor.adminlte.auth.login');
});

Auth::routes([
    'register' => false, // Registration Routes...
    'reset' => false, // Password Reset Routes...
    'verify' => false, // Email Verification Routes...
]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['middleware' => 'admin', 'prefix' => 'admin'], function () {
    Route::resource('languages', 'App\Http\Controllers\Admin\LanguagesController');

    Route::resource('translates', 'App\Http\Controllers\Admin\TranslatesController');

    Route::resource('countries', 'App\Http\Controllers\Admin\CountriesController');

    Route::resource('users', 'App\Http\Controllers\Admin\UsersController');
    Route::resource('users/{userId}/addresses', 'App\Http\Controllers\Admin\UserAddressesController');

    Route::resource('reviews', 'App\Http\Controllers\Admin\ReviewsController');

    Route::resource('socials', 'App\Http\Controllers\Admin\SocialsController');

    Route::resource('banks', 'App\Http\Controllers\Admin\BanksController');

    Route::resource('banners', 'App\Http\Controllers\Admin\BannersController');

    Route::resource('cities', 'App\Http\Controllers\Admin\CitiesController');

    Route::resource('regions', 'App\Http\Controllers\Admin\RegionsController');
    Route::get('country-cities/{id}', [CitiesController::class, 'byCountry']);

    Route::resource('error-codes', 'App\Http\Controllers\Admin\ErrorCodesController');

    Route::resource('courses', 'App\Http\Controllers\Admin\CoursesController');

    Route::resource('course-programs', 'App\Http\Controllers\Admin\CourseProgramsController');
    Route::get('course-programs/course/{course_id}', [CourseProgramsController::class, 'index']);
    Route::get('course-programs/{id}/edit/{parent_id}', [CourseProgramsController::class, 'edit']);
    Route::get('course-programs/create/{parent_id}', [CourseProgramsController::class, 'create']);

    Route::resource('terms-and-conditions', 'App\Http\Controllers\Admin\TermsAndConditionsController');

    Route::resource('blocks', 'App\Http\Controllers\Admin\BlocksController');
    Route::get('block-items/block/{block_id}', [BlockItemsController::class, 'index']);
    Route::get('block-items/{id}/edit/{block_id}', [BlockItemsController::class, 'edit']);
    Route::get('block-items/create/{block_id}', [BlockItemsController::class, 'create']);
    Route::resource('block-items', 'App\Http\Controllers\Admin\BlockItemsController');

    Route::resource('tariffs', 'App\Http\Controllers\Admin\TariffsController');

    Route::resource('news-categories', 'App\Http\Controllers\Admin\NewsCategoriesController');
    Route::get('news-categories/news/{news_category_id}', [NewsController::class, 'index']);
    Route::get('news-categories/{id}/edit/{news_category_id}', [NewsController::class, 'edit']);
    Route::get('news-categories/create/{news_category_id}', [NewsController::class, 'create']);
    Route::post('news-categories/{id}/news/{news_category_id}/destroy', [NewsController::class, 'destroy']);

    Route::resource('news', 'App\Http\Controllers\Admin\NewsController');

    Route::resource('faqs', 'App\Http\Controllers\Admin\FaqsController');

    Route::resource('contacts', 'App\Http\Controllers\Admin\ContactsController');

    Route::resource('disclaimers', 'App\Http\Controllers\Admin\DisclaimersController');

    Route::get('tariff-items/tariff/{tariff_id}', [TariffItemsController::class, 'index']);
    Route::get('tariff-items/{id}/edit/{tariff_id}', [TariffItemsController::class, 'edit']);
    Route::get('tariff-items/create/{tariff_id}', [TariffItemsController::class, 'create']);
    Route::resource('tariff-items', 'App\Http\Controllers\Admin\TariffItemsController');

    Route::resource('speakers', 'App\Http\Controllers\Admin\SpeakersController');

    Route::resource('pages', 'App\Http\Controllers\Admin\PagesController');

    Route::resource('page-items', 'App\Http\Controllers\Admin\PageItemsController');
    Route::get('page-items/page/{page_id}', [PageItemsController::class, 'index']);
    Route::get('page-items/{id}/edit/{page_id}', [PageItemsController::class, 'edit']);
    Route::get('page-items/create/{page_id}', [PageItemsController::class, 'create']);

    Route::resource('course-lessons', 'App\Http\Controllers\Admin\CourseLessonsController');
    Route::get('course-lessons/course/{course_id}', [CourseLessonsController::class, 'index']);
    Route::get('course-lessons/{id}/edit/{course_id}', [CourseLessonsController::class, 'edit']);
    Route::get('course-lessons/create/{course_id}', [CourseLessonsController::class, 'create']);

    Route::resource('subscriptions', 'App\Http\Controllers\Admin\SubscriptionsController');

    Route::resource('applications', 'App\Http\Controllers\Admin\ApplicationsController');

    Route::resource('notifications', 'App\Http\Controllers\Admin\NotificationsController');
});






