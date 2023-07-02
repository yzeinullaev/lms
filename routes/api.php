<?php

use App\Http\Controllers\API\ApplicationApiController;
use App\Http\Controllers\API\PageApiController;
use App\Http\Controllers\API\PaymentApiController;
use App\Http\Controllers\API\ReviewApiController;
use App\Http\Controllers\API\UserApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware(['auth:sanctum', 'checkHeader'])->group(function () {
    Route::post('logout', [UserApiController::class, 'logout'])->name('logout');
    Route::post('change-password', [UserApiController::class, 'changePassword'])->name('changePassword');
    Route::get('user-info', [UserApiController::class, 'userInfo'])->name('userInfo');

    Route::post('payment', [PaymentApiController::class, 'payment'])->name('payment');

    // Отзовы
    Route::get('review', [ReviewApiController::class, 'getByUser'])->name('reviewByUser');
    Route::post('review-create', [ReviewApiController::class, 'create'])->name('reviewCreate');
    // отписка от новостей
    Route::post('news-unsubscribe', [UserApiController::class, 'unsubscribe'])->name('unsubscribe');
});

Route::post('payment-result-success', [PaymentApiController::class, 'paymentSuccess'])->name('paymentSuccess');
Route::post('payment-result-failed', [PaymentApiController::class, 'paymentFailed'])->name('paymentFailed');

Route::middleware('checkHeader')->group(function () {
    Route::post('registration', [UserApiController::class, 'registration'])->name('registration');
    Route::post('login', [UserApiController::class, 'login'])->name('login');

    Route::get('page-by-slug', [PageApiController::class, 'getBySlug'])->name('page');

    // Оставить заявку
    Route::post('submit-application', [ApplicationApiController::class, 'sendApplication'])->name('sendApplicationMail');
});
